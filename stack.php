<?php
// Refs: https://www.programiz.com/dsa/stack
function create_stack()
{
  $stack = [];
  return $stack;
}

function is_empty_stack($stack)
{
  return count($stack) == 0;
}

function push_in_stack($item, $stack)
{
  $stack[] = $item;
  return $stack;
}

function pop_out_stack(&$stack)
{
  if (is_empty_stack($stack)) {
    return null;
  }
  return array_pop($stack);
}
