<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    info: new OA\Info(
        title: 'Products API',
        version: '1.0.0',
        description: 'Product search API'
    )
)]
class OpenApi {}
