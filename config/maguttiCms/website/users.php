<?php

use App\maguttiCms\Domain\User\UserFeatures;

return [
    'features' => [
       UserFeatures::profileAvatar(),
       //UserFeatures::accountDeletion(), to be implemented
    ]
];
