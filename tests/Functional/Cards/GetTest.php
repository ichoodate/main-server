<?php

namespace Tests\Functional\Cards;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use App\Services\Card\CardListingService;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/cards';

    public function test()
    {
        $namedIds = [];
        $rand = rand(0, 1);
        $user1 = User::factory()->create([
            User::ID => 1,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN,
        ]);
        $user2 = User::factory()->create([
            User::ID => 2,
            User::GENDER => $rand ? User::GENDER_WOMAN : User::GENDER_MAN,
        ]);
        $user3 = User::factory()->create([
            User::ID => 3,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN,
        ]);

        Match::factory()->create([
            Match::MAN_ID => $rand ? 1 : 2,
            Match::WOMAN_ID => $rand ? 2 : 1,
            Match::FRIENDS => [[
                Friend::SENDER_ID => 1,
                Friend::RECEIVER_ID => 2,
            ]],
            Match::CARDS => [[
                Card::ID => $namedIds['1_ch_none_2_sh_none'] = 110,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::FLIPS => [],
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_none'] = 120,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::FLIPS => [[
                    CardFlip::USER_ID => 1,
                ]],
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_flip'] = 150,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::FLIPS => [[
                    CardFlip::USER_ID => 2,
                ]],
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_flip'] = 160,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::FLIPS => [[
                    CardFlip::USER_ID => 1,
                ], [
                    CardFlip::USER_ID => 2,
                ]],
            ], [
                Card::ID => $namedIds['2_ch_flip_1_sh_flip'] = 270,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 1,
                Card::FLIPS => [[
                    CardFlip::USER_ID => 2,
                ], [
                    CardFlip::USER_ID => 1,
                ]],
            ]],
        ]);

        Match::factory()->create([
            Match::MAN_ID => $rand ? 3 : 2,
            Match::WOMAN_ID => $rand ? 2 : 3,
            Match::FRIENDS => [[
                Friend::SENDER_ID => 2,
                Friend::RECEIVER_ID => 3,
            ]],
            Match::CARDS => [[
                Card::ID => $namedIds['2_ch_flip_3_sh_flip'] = 280,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 3,
                Card::FLIPS => [[
                    CardFlip::USER_ID => 2,
                ], [
                    CardFlip::USER_ID => 3,
                ]],
            ]],
        ]);

        foreach ([[ // 0
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none'],
        ], [ // 1
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            CardListingService::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip'],
        ], [ // 2
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            CardListingService::USER_STATUS_FRIEND_STEP,
            ['1_ch_none_2_sh_flip'],
        ], [ // 3
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            CardListingService::USER_STATUS_FRIEND,
            [],
        ], [ // 4
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_none_2_sh_flip'],
        ], [ // 5
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none'],
        ], [ // 6
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP,
            CardListingService::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip'],
        ], [ // 7
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP,
            CardListingService::USER_STATUS_FRIEND_STEP,
            ['1_ch_flip_2_sh_flip'],
        ], [ // 8
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP,
            CardListingService::USER_STATUS_FRIEND,
            [],
        ], [ // 9
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_CARD_FLIP,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_flip_2_sh_flip'],
        ], [ // 10
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND_STEP,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            [],
        ], [ // 11
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND_STEP,
            CardListingService::USER_STATUS_CARD_FLIP,
            [],
        ], [ // 12
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND_STEP,
            CardListingService::USER_STATUS_FRIEND_STEP,
            [],
        ], [ // 13
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND_STEP,
            CardListingService::USER_STATUS_FRIEND,
            [],
        ], [ // 14
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND_STEP,
            CardListingService::USER_STATUS_ALL,
            [],
        ], [ // 15
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none'],
        ], [ // 16
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip'],
        ], [ // 17
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_FRIEND_STEP,
            ['1_ch_flip_2_sh_flip'],
        ], [ // 18
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_FRIEND,
            [],
        ], [ // 19
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_flip_2_sh_flip'],
        ], [ // 20
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none'],
        ], [ // 21
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip'],
        ], [ // 22
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_FRIEND_STEP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip'],
        ], [ // 23
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_FRIEND,
            [],
        ], [ // 24
            1,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip'],
        ], [ // 25
            1,
            CardListingService::CARD_TYPE_SHOWNER,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_ALL,
            ['2_ch_flip_1_sh_flip'],
        ], [ // 26
            1,
            CardListingService::CARD_TYPE_BOTH,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '2_ch_flip_1_sh_flip'],
        ], [ // 27
            2,
            CardListingService::CARD_TYPE_CHOOSER,
            CardListingService::USER_STATUS_FRIEND,
            CardListingService::USER_STATUS_ALL,
            ['2_ch_flip_3_sh_flip'],
        ], [ // 28
            2,
            CardListingService::CARD_TYPE_BOTH,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '2_ch_flip_1_sh_flip', '2_ch_flip_3_sh_flip'],
        ], [ // 29
            3,
            CardListingService::CARD_TYPE_BOTH,
            CardListingService::USER_STATUS_ALL,
            CardListingService::USER_STATUS_ALL,
            ['2_ch_flip_3_sh_flip'],
        ]] as $i => $args) {
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
