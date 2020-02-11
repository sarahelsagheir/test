<?php
$test1=DB::table('messages')
  ->where('read',0)
  ->where('to',Auth::user()->id)
  ->count();
  echo $test1;
