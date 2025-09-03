<?php

declare(strict_types = 1);

namespace App\Enums;

enum Pages: string {
  case HOME = '/';
  case ALL_TESTS = '/tests';
  case CIRCLE_TESTS = '/tests/circle';
  case SQUARE_TESTS = '/tests/square';
  case USER_TESTS = '/tests/user';
  case SHAPESCOLLECTION_TESTS = '/tests/shapescollection';
  case NOT_FOUND = '/404';
  case NOT_SET = '/notset';

  public function getClassName(Pages $page): string {
    return match($page) {
      self::HOME => 'Home',
      self::ALL_TESTS => 'AllTests',
      self::CIRCLE_TESTS => 'CircleTests',
      self::SQUARE_TESTS => 'SquareTests',
      self::USER_TESTS => 'UserTests',
      self::SHAPESCOLLECTION_TESTS => 'ShapesCollectionTests',
      self::NOT_FOUND => 'NotFound',
      self::NOT_SET => 'NotSet',
      default => 'NotFound',
    };
  }
}
