<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace Tests\Feature;

use phpDocumentor\Reflection\Types\Integer;
use Tests\TestCase;
use CodersStudio\DadataApi\Facades\DadataApi;

class CleanTest extends TestCase
{

    /**
     * Test clean address
     */
    public function testAddress()
    {
        $result = DadataApi::cleanAddress("Ставрополь Мира 123");
        $this->assertEquals(true, is_array($result));
        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('result', $result[0]);
        $this->assertEquals("г Ставрополь, ул Мира, д 123", $result[0]['result']);
    }
}
