<?php
// Parser.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'config'];

    protected $casts = [
        'parser_json' => 'array', // This will automatically cast the JSON string in this field to an array
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Parse content based on the parser instructions.
     *
     * @param string $url The URL to scrape
     * @return array Parsed data
     */
    public function parseContent($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        // Let's say the 'parser_json' contains CSS selectors to extract certain data
        $parsedData = [];
        foreach ($this->parser_json as $key => $cssSelector) {
            $parsedData[$key] = $crawler->filter($cssSelector)->each(function ($node) {
                return trim($node->text());
            });
        }

        return $parsedData;
    }
}
