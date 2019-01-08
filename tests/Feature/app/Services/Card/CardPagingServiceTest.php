<?php

namespace Tests\Feature\App\Services\Card;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Feature\App\Services\_TestCase;

class CardPagingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => $this->authUser,
            'card_type'
                => $this->cardType,
            'auth_user_status'
                => $this->authUserStatus,
            'matching_user_status'
                => $this->matchingUserStatus,
            'limit'
                => 100
        ], [
            'auth_user'
                => 'authorized user',
            'card_type'
                => '[card_type]',
            'auth_user_status'
                => '[auth_user_status]',
            'matching_user_status'
                => '[matching_user_status]',
            'fields'
                => '[fields]',
            'limit'
                => '[limit]',
            'order_by'
                => '[order_by]'
        ]];
    }

    public function testResult()
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
                Card::ID => $namedIds['1_ch_none_2_sh_none'] = 201,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => []
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_none'] = 202,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_none'] = 203,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_none'] = 204,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_flip'] = 205,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_flip'] = 206,
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
                Card::ID => $namedIds['1_ch_open_2_sh_flip'] = 207,
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
                Card::ID => $namedIds['1_ch_prop_2_sh_flip'] = 208,
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
                Card::ID => $namedIds['1_ch_none_2_sh_open'] = 209,
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
                Card::ID => $namedIds['1_ch_flip_2_sh_open'] = 210,
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
                Card::ID => $namedIds['1_ch_open_2_sh_open'] = 211,
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
                Card::ID => $namedIds['1_ch_prop_2_sh_open'] = 212,
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
                Card::ID => $namedIds['1_ch_none_2_sh_prop'] = 213,
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
                Card::ID => $namedIds['1_ch_flip_2_sh_prop'] = 214,
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
                Card::ID => $namedIds['1_ch_open_2_sh_prop'] = 215,
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
                Card::ID => $namedIds['1_ch_prop_2_sh_prop'] = 216,
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
                Card::ID => $namedIds['2_ch_flip_1_sh_open'] = 217,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 1,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ]]
        ]);

        $this->factory(Match::class)->create([
            Match::MAN_ID => $rand ? 3 : 2,
            Match::WOMAN_ID => $rand ? 2 : 3,
            Match::CARDS => [[
                Card::ID => $namedIds['2_ch_flip_3_sh_open'] = 218,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 3,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ]]
        ]);


        foreach ( [[ // 0
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none']
        ], [ // 1
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 2
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip']
        ], [ // 3
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 4
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open']
        ], [ // 5
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop']
        ], [ // 6
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 7
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 8
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 9
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 10
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 11
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 12
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 13
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 14
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none']
        ], [ // 15
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 16
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip']
        ], [ // 17
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 18
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open']
        ], [ // 19
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop']
        ], [ // 20
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 21
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 22
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 23
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 24
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 25
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 26
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 27
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 28
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none']
        ], [ // 29
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 30
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip']
        ], [ // 31
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 32
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open']
        ], [ // 33
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop']
        ], [ // 34
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 35
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_prop_2_sh_none']
        ], [ // 36
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 37
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_prop_2_sh_flip']
        ], [ // 38
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 39
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_prop_2_sh_open']
        ], [ // 40
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_prop_2_sh_prop']
        ], [ // 41
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_ALL,
            ['1_ch_prop_2_sh_none', '1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 42
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 43
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 44
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 45
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 46
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 47
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 48
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 49
            1,
            static::class()::CARD_TYPE_SHOWNER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['2_ch_flip_1_sh_open']
        ], [ // 50
            1,
            static::class()::CARD_TYPE_BOTH,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop', '2_ch_flip_1_sh_open']
        ], [ // 51
            2,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ], [ // 52
            2,
            static::class()::CARD_TYPE_BOTH,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_open', '2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ]] as $i => $args )
        {
            $this->authUser           = User::find($args[0]);
            $this->cardType           = $args[1];
            $this->authUserStatus     = $args[2];
            $this->matchingUserStatus = $args[3];

            $expectIds = array_only($namedIds, $args[4]);

            $this->assertResult(Card::find($expectIds));
        }
    }

}
