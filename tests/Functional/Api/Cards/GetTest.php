<?php

namespace Tests\Functional\Api\Cards;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Card\CardPagingService;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/cards';

    public function test()
    {
        $namedIds = [];
        $rand = rand(0, 1);
        $user1 = $this->factory(User::class)->create([
            User::ID => 1,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN
        ]);
        $user2 = $this->factory(User::class)->create([
            User::ID => 2,
            User::GENDER => $rand ? User::GENDER_WOMAN : User::GENDER_MAN
        ]);
        $user3 = $this->factory(User::class)->create([
            User::ID => 3,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN
        ]);

        $this->factory(Match::class)->create([
            Match::MAN_ID => $rand ? 1 : 2,
            Match::WOMAN_ID => $rand ? 2 : 1,
            Match::CARDS => [[
                Card::ID => $namedIds['1_ch_none_2_sh_none'] = 110,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => []
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_none'] = 120,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_none'] = 130,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_none'] = 140,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_flip'] = 150,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_flip'] = 160,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_flip'] = 170,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1,
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_flip'] = 180,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_open'] = 190,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_open'] = 200,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_open'] = 210,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_open'] = 220,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_prop'] = 230,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_prop'] = 240,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_prop'] = 250,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_prop'] = 260,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['2_ch_flip_1_sh_open'] = 270,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 1,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ]]
            ]]
        ]);

        $this->factory(Match::class)->create([
            Match::MAN_ID => $rand ? 3 : 2,
            Match::WOMAN_ID => $rand ? 2 : 3,
            Match::CARDS => [[
                Card::ID => $namedIds['2_ch_flip_3_sh_open'] = 280,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 3,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 3
                ]]
            ]]
        ]);

        foreach ( [[ // 0
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none']
        ], [ // 1
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 2
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip']
        ], [ // 3
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 4
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open']
        ], [ // 5
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop']
        ], [ // 6
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 7
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 8
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 9
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 10
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 11
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 12
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 13
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_FLIP,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 14
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none']
        ], [ // 15
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 16
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip']
        ], [ // 17
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 18
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open']
        ], [ // 19
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop']
        ], [ // 20
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 21
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 22
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 23
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 24
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 25
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 26
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 27
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 28
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none']
        ], [ // 29
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 30
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip']
        ], [ // 31
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 32
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open']
        ], [ // 33
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop']
        ], [ // 34
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 35
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_prop_2_sh_none']
        ], [ // 36
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 37
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_prop_2_sh_flip']
        ], [ // 38
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 39
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_prop_2_sh_open']
        ], [ // 40
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_prop_2_sh_prop']
        ], [ // 41
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_prop_2_sh_none', '1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 42
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 43
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 44
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 45
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 46
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 47
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 48
            1,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 49
            1,
            CardPagingService::CARD_TYPE_SHOWNER,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_ALL,
            ['2_ch_flip_1_sh_open']
        ], [ // 50
            1,
            CardPagingService::CARD_TYPE_BOTH,
            CardPagingService::USER_STATUS_ALL,
            CardPagingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop', '2_ch_flip_1_sh_open']
        ], [ // 51
            2,
            CardPagingService::CARD_TYPE_CHOOSER,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ], [ // 52
            2,
            CardPagingService::CARD_TYPE_BOTH,
            CardPagingService::USER_STATUS_CARD_OPEN_STEP,
            CardPagingService::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_flip', '2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ]] as $i => $args )
        {
            $this->when(function () use ($args, $namedIds) {

                $authUser = User::find($args[0]);
                $cardType = $args[1];
                $authUserStatus = $args[2];
                $matchingUserStatus = $args[3];
                $expectIds = array_values(array_only($namedIds, $args[4]));

                $this->setAuthUser($authUser);
                $this->setInputParameter('card_type', $cardType);
                $this->setInputParameter('auth_user_status', $authUserStatus);
                $this->setInputParameter('matching_user_status', $matchingUserStatus);
                $this->setInputParameter('limit', 100);

                $this->assertResultWithPaging($expectIds);
            });
        }
    }

}
