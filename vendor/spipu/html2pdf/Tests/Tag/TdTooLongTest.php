<?php
/**
 * Html2Pdf Library - Tests
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2025 Laurent MINGUET
 */

namespace Spipu\Html2Pdf\Tests\Tag;

use Spipu\Html2Pdf\Tests\AbstractTest;

/**
 * Class TdTooLongTest
 */
class TdTooLongTest extends AbstractTest
{
    /**
     * test
     *
     * @return void
     */
    public function testCase()
    {
        $this->expectException(\Spipu\Html2Pdf\Exception\TableException::class);
        $sentence = 'Hello World ! ';
        $sentences = '';
        for ($k=0; $k<100; $k++) {
            $sentences.= $sentence;
        }

        $object = $this->getObject();
        $object->writeHTML('<table><tr><td style="width: 28mm">'.$sentences.'</td></tr></table>');
        $object->output('test.pdf', 'S');
    }
}
