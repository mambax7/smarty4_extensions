<?php

declare(strict_types=1);

namespace Xoops\SmartyExtensions\Test\Extension;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Xoops\SmartyExtensions\Extension\DataExtension;

#[CoversClass(DataExtension::class)]
final class DataExtensionTest extends TestCase
{
    private DataExtension $ext;

    protected function setUp(): void
    {
        $this->ext = new DataExtension();
    }

    // ---------------------------------------------------------------
    //  Registry counts
    // ---------------------------------------------------------------

    #[Test]
    public function getFunctionsReturnsSevenEntries(): void
    {
        $functions = $this->ext->getFunctions();
        $this->assertCount(7, $functions);
        $this->assertArrayHasKey('array_to_csv', $functions);
        $this->assertArrayHasKey('base64_encode_file', $functions);
        $this->assertArrayHasKey('embed_pdf', $functions);
        $this->assertArrayHasKey('generate_xml_sitemap', $functions);
        $this->assertArrayHasKey('generate_meta_tags', $functions);
        $this->assertArrayHasKey('get_referrer', $functions);
        $this->assertArrayHasKey('get_session_data', $functions);
    }

    #[Test]
    public function getModifiersReturnsSevenEntries(): void
    {
        $modifiers = $this->ext->getModifiers();
        $this->assertCount(7, $modifiers);
        $this->assertArrayHasKey('array_filter', $modifiers);
        $this->assertArrayHasKey('array_sort', $modifiers);
        $this->assertArrayHasKey('pretty_print_json', $modifiers);
        $this->assertArrayHasKey('get_file_size', $modifiers);
        $this->assertArrayHasKey('get_mime_type', $modifiers);
        $this->assertArrayHasKey('is_image', $modifiers);
        $this->assertArrayHasKey('strip_html_comments', $modifiers);
    }

    // ---------------------------------------------------------------
    //  Modifier tests
    // ---------------------------------------------------------------

    #[Test]
    public function arrayFilterFiltersByKeyValue(): void
    {
        $items = [
            ['status' => 'active', 'name' => 'Alice'],
            ['status' => 'inactive', 'name' => 'Bob'],
            ['status' => 'active', 'name' => 'Carol'],
        ];

        $result = $this->ext->arrayFilter($items, 'status', 'active');

        $this->assertCount(2, $result);
        $this->assertSame('Alice', $result[0]['name']);
        $this->assertSame('Carol', $result[1]['name']);
    }

    #[Test]
    public function arrayFilterReturnsEmptyWhenNoMatch(): void
    {
        $items = [
            ['status' => 'inactive', 'name' => 'Bob'],
        ];

        $result = $this->ext->arrayFilter($items, 'status', 'active');

        $this->assertSame([], $result);
    }

    #[Test]
    public function arraySortSortsByKey(): void
    {
        $items = [
            ['name' => 'Charlie', 'age' => 30],
            ['name' => 'Alice', 'age' => 25],
            ['name' => 'Bob', 'age' => 28],
        ];

        $result = $this->ext->arraySort($items, 'name');

        $this->assertSame('Alice', $result[0]['name']);
        $this->assertSame('Bob', $result[1]['name']);
        $this->assertSame('Charlie', $result[2]['name']);
    }

    #[Test]
    public function arraySortSortsByKeyDescending(): void
    {
        $items = [
            ['name' => 'Alice'],
            ['name' => 'Charlie'],
            ['name' => 'Bob'],
        ];

        $result = $this->ext->arraySort($items, 'name', 'desc');

        $this->assertSame('Charlie', $result[0]['name']);
        $this->assertSame('Bob', $result[1]['name']);
        $this->assertSame('Alice', $result[2]['name']);
    }

    #[Test]
    public function arraySortSortsByValueWhenNoKey(): void
    {
        $items = ['cherry', 'apple', 'banana'];

        $result = $this->ext->arraySort($items);

        $this->assertSame('apple', \array_values($result)[0]);
        $this->assertSame('banana', \array_values($result)[1]);
        $this->assertSame('cherry', \array_values($result)[2]);
    }

    #[Test]
    public function prettyPrintJsonFormatsArray(): void
    {
        $data = ['name' => 'XOOPS', 'version' => 2];

        $result = $this->ext->prettyPrintJson($data);

        $this->assertStringContainsString('"name": "XOOPS"', $result);
        $this->assertStringContainsString('"version": 2', $result);
        // Pretty-print adds newlines
        $this->assertStringContainsString("\n", $result);
    }

    #[Test]
    public function prettyPrintJsonDecodesJsonString(): void
    {
        $json = '{"a":1}';

        $result = $this->ext->prettyPrintJson($json);

        $this->assertStringContainsString('"a": 1', $result);
        $this->assertStringContainsString("\n", $result);
    }

    #[Test]
    public function isImageReturnsTrueForImageExtensions(): void
    {
        $this->assertTrue($this->ext->isImage('photo.png'));
        $this->assertTrue($this->ext->isImage('photo.jpg'));
        $this->assertTrue($this->ext->isImage('photo.jpeg'));
        $this->assertTrue($this->ext->isImage('photo.gif'));
        $this->assertTrue($this->ext->isImage('photo.webp'));
        $this->assertTrue($this->ext->isImage('photo.svg'));
        $this->assertTrue($this->ext->isImage('photo.avif'));
        $this->assertTrue($this->ext->isImage('photo.bmp'));
        $this->assertTrue($this->ext->isImage('photo.ico'));
    }

    #[Test]
    public function isImageReturnsFalseForNonImageExtensions(): void
    {
        $this->assertFalse($this->ext->isImage('readme.txt'));
        $this->assertFalse($this->ext->isImage('style.css'));
        $this->assertFalse($this->ext->isImage('script.php'));
        $this->assertFalse($this->ext->isImage('document.pdf'));
    }

    #[Test]
    public function stripHtmlCommentsRemovesComments(): void
    {
        $html = '<div><!-- hidden comment -->visible</div>';

        $result = $this->ext->stripHtmlComments($html);

        $this->assertSame('<div>visible</div>', $result);
    }

    #[Test]
    public function stripHtmlCommentsRemovesMultilineComments(): void
    {
        $html = "<p>before</p>\n<!--\nmultiline\ncomment\n-->\n<p>after</p>";

        $result = $this->ext->stripHtmlComments($html);

        $this->assertStringNotContainsString('<!--', $result);
        $this->assertStringContainsString('<p>before</p>', $result);
        $this->assertStringContainsString('<p>after</p>', $result);
    }

    // ---------------------------------------------------------------
    //  Function tests (assign pattern)
    // ---------------------------------------------------------------

    #[Test]
    public function arrayToCsvConvertsTwoDimensionalArray(): void
    {
        $template = $this->createMockTemplate();

        $result = $this->ext->arrayToCsv(
            ['array' => [['Alice', 30], ['Bob', 25]]],
            $template,
        );

        $this->assertStringContainsString('Alice', $result);
        $this->assertStringContainsString('Bob', $result);
    }

    #[Test]
    public function arrayToCsvReturnsEmptyForEmptyArray(): void
    {
        $template = $this->createMockTemplate();

        $result = $this->ext->arrayToCsv(['array' => []], $template);

        $this->assertSame('', $result);
    }

    #[Test]
    public function arrayToCsvAssignsToTemplateWhenAssignSet(): void
    {
        $template = $this->createMockTemplate();
        $template->expects($this->once())
            ->method('assign')
            ->with('csv_output', $this->isType('string'));

        $result = $this->ext->arrayToCsv(
            ['array' => [['Alice', 30]], 'assign' => 'csv_output'],
            $template,
        );

        $this->assertSame('', $result);
    }

    #[Test]
    public function embedPdfReturnsIframeHtml(): void
    {
        $template = $this->createMockTemplate();

        $result = $this->ext->embedPdf(
            ['url' => 'uploads/doc.pdf', 'width' => '800', 'height' => '500'],
            $template,
        );

        $this->assertStringContainsString('<iframe', $result);
        $this->assertStringContainsString('uploads/doc.pdf', $result);
        $this->assertStringContainsString('width="800"', $result);
        $this->assertStringContainsString('height="500"', $result);
    }

    #[Test]
    public function embedPdfReturnsEmptyForMissingUrl(): void
    {
        $template = $this->createMockTemplate();

        $result = $this->ext->embedPdf([], $template);

        $this->assertSame('', $result);
    }

    #[Test]
    public function generateXmlSitemapProducesValidXml(): void
    {
        $template = $this->createMockTemplate();
        $pages = [
            ['url' => 'https://example.com/', 'priority' => '1.0', 'lastmod' => '2026-03-20', 'changefreq' => 'daily'],
        ];

        $result = $this->ext->generateXmlSitemap(['pages' => $pages], $template);

        $this->assertStringContainsString('<?xml version="1.0"', $result);
        $this->assertStringContainsString('<urlset', $result);
        $this->assertStringContainsString('<loc>https://example.com/</loc>', $result);
        $this->assertStringContainsString('<priority>1.0</priority>', $result);
        $this->assertStringContainsString('<lastmod>2026-03-20</lastmod>', $result);
        $this->assertStringContainsString('<changefreq>daily</changefreq>', $result);
    }

    #[Test]
    public function generateMetaTagsProducesMetaElements(): void
    {
        $template = $this->createMockTemplate();
        $config = ['description' => 'My page', 'robots' => 'index,follow'];

        $result = $this->ext->generateMetaTags(['config' => $config], $template);

        $this->assertStringContainsString('<meta name="description" content="My page">', $result);
        $this->assertStringContainsString('<meta name="robots" content="index,follow">', $result);
    }

    #[Test]
    public function generateMetaTagsReturnsEmptyForEmptyConfig(): void
    {
        $template = $this->createMockTemplate();

        $result = $this->ext->generateMetaTags(['config' => []], $template);

        $this->assertSame('', $result);
    }

    #[Test]
    public function embedPdfAssignsWhenAssignSet(): void
    {
        $template = $this->createMockTemplate();
        $template->expects($this->once())
            ->method('assign')
            ->with('pdf_html', $this->isType('string'));

        $result = $this->ext->embedPdf(
            ['url' => 'doc.pdf', 'assign' => 'pdf_html'],
            $template,
        );

        $this->assertSame('', $result);
    }

    // ---------------------------------------------------------------
    //  Helper
    // ---------------------------------------------------------------

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject&object
     */
    private function createMockTemplate(): object
    {
        return $this->createMock(SmartyTemplateMock::class);
    }
}

/**
 * Minimal interface for mocking Smarty template assign().
 *
 * @internal
 */
abstract class SmartyTemplateMock
{
    abstract public function assign(string $name, mixed $value): void;
}
