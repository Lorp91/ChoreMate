<?php

test('the application shows the landingpage', function () {
    visit('/')->assertSee('ChoreMate');
});
