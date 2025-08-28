<?php

declare(strict_types = 1);

namespace App\Enums;

enum Shapes: string {
  case CIRCLE = 'Circle';
  case SQUARE = 'Square';
  case TRIANGLE = 'Triangle';
  case RECTANGLE = 'Rectangle';
  case RHOMBUS = 'Rhombus';
  case ELLIPSE = 'Ellipse';
  case KITE = 'Kite';
  case TRAPEZOID = 'Trapezoid';
  case PENTAGON = 'Pentagon';
  case HEXAGON = 'Hexagon';
  case OCTAGON = 'Octagon';
}
