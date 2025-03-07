<?php

return [
    'default' => [
        'wrapper'           => "<ul class='pagination'>{pagination}</ul>",
        'previous'          => "<li class='page-item'>{link}</li>",
        'previous-marker'   => "&laquo;",
        'previous-link'     => "<a class='page-link' href=\"{uri}\">{page}</a>",
        'previous-inactive' => "<li class='page-item disabled'><span class='page-link'>&laquo;</span></li>",
        'regular'           => "<li class='page-item'>{link}</li>",
        'regular-link'      => "<a class='page-link' href=\"{uri}\">{page}</a>",
        'active'            => "<li class='page-item active'><span class='page-link'>{link}</span></li>",
        'next'              => "<li class='page-item'>{link}</li>",
        'next-marker'       => "&raquo;",
        'next-link'         => "<a class='page-link' href=\"{uri}\">{page}</a>",
        'next-inactive'     => "<li class='page-item disabled'><span class='page-link'>&raquo;</span></li>",
    ],
];

