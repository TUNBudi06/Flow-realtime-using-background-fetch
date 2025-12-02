<?php

use App\Domain\Tractor\ValueObjects\UserInfo;

describe('UserInfo', function () {
    it('creates user info with name and nik', function () {
        $userInfo = UserInfo::create('John Doe', '12345678');

        expect($userInfo->name())->toBe('John Doe')
            ->and($userInfo->nik())->toBe('12345678');
    });

    it('trims whitespace from values', function () {
        $userInfo = UserInfo::create('  John Doe  ', '  12345678  ');

        expect($userInfo->name())->toBe('John Doe')
            ->and($userInfo->nik())->toBe('12345678');
    });

    it('allows empty values', function () {
        $userInfo = UserInfo::create('', '');

        expect($userInfo->name())->toBe('')
            ->and($userInfo->nik())->toBe('');
    });

    it('compares equality correctly', function () {
        $userInfo1 = UserInfo::create('John Doe', '12345678');
        $userInfo2 = UserInfo::create('John Doe', '12345678');
        $userInfo3 = UserInfo::create('Jane Doe', '87654321');

        expect($userInfo1->equals($userInfo2))->toBeTrue()
            ->and($userInfo1->equals($userInfo3))->toBeFalse();
    });
});
