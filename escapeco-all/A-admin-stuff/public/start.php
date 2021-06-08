<?php

require('json-rpc.php');

class Start {
  function start() {
    return "[[ terminal::push('commands.php', { prompt: '$ ', login: true}) ]]";
  }
}

handle_json_rpc(new Start());
