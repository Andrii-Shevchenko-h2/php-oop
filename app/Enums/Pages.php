<?php

declare(strict_types = 1);

namespace App\Enums;

enum Pages: string {
  case HOME = '/';
  case TESTS = '/tests';
  case NOT_FOUND = '/404';
  case NOT_SET = '/notset';

  public function getClassName(Pages $page): string {
    return match($page) {
      self::HOME => 'Home',
      self::TESTS => 'Tests',
      self::NOT_FOUND => 'NotFound',
      self::NOT_SET => 'NotSet',
      default => 'NotFound',
    };
  }
}
