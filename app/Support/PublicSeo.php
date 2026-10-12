<?php

namespace App\Support;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class PublicSeo
{
    /**
     * @param  array<int, object>  $faqs
     * @return array<string, mixed>
     */
    public static function page(
        string $routeName,
        string $title,
        string $description,
        string $canonical,
        string $image,
        ?Model $record = null,
        array $faqs = [],
    ): array {
        $image = self::absoluteImage($image);
        [$imageWidth, $imageHeight, $imageType] = self::imageDetails($image);
        $organisationId = route('home').'#organisation';
        $websiteId = route('home').'#website';
        $webpageId = $canonical.'#webpage';
        $mapUrl = 'https://www.google.com/maps/search/?api=1&query='.rawurlencode(config('site.map_query'));

        $graph = [
            [
                '@type' => ['Organization', 'ProfessionalService'],
                '@id' => $organisationId,
                'name' => config('site.name'),
                'alternateName' => 'School House Consult',
                'url' => route('home'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset(config('site.logo')),
                ],
                'image' => asset('images/social-card.png'),
                'description' => config('site.mission'),
                'email' => config('site.email'),
                'telephone' => array_values(config('site.phones')),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'First Floor Ekundayo House, Oda Road',
                    'addressLocality' => 'Akure',
                    'addressRegion' => 'Ondo State',
                    'addressCountry' => 'NG',
                ],
                'hasMap' => $mapUrl,
            ],
            [
                '@type' => 'WebSite',
                '@id' => $websiteId,
                'url' => route('home'),
                'name' => 'School House Consult',
                'description' => config('site.mission'),
                'publisher' => ['@id' => $organisationId],
                'inLanguage' => 'en-NG',
            ],
            [
                '@type' => 'WebPage',
                '@id' => $webpageId,
                'url' => $canonical,
                'name' => $title,
                'description' => $description,
                'isPartOf' => ['@id' => $websiteId],
                'about' => ['@id' => $organisationId],
                'primaryImageOfPage' => [
                    '@type' => 'ImageObject',
                    'url' => $image,
                    'width' => $imageWidth,
                    'height' => $imageHeight,
                ],
                'breadcrumb' => ['@id' => $canonical.'#breadcrumb'],
                'inLanguage' => 'en-NG',
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $canonical.'#breadcrumb',
                'itemListElement' => self::breadcrumbs($routeName, $canonical, $title),
            ],
        ];

        if ($record instanceof Article) {
            $graph[] = array_filter([
                '@type' => 'Article',
                '@id' => $canonical.'#article',
                'headline' => $record->title,
                'description' => $description,
                'image' => $image,
                'datePublished' => $record->published_at?->toIso8601String(),
                'dateModified' => $record->updated_at?->toIso8601String(),
                'author' => $record->author ? ['@type' => 'Person', 'name' => $record->author] : ['@id' => $organisationId],
                'publisher' => ['@id' => $organisationId],
                'mainEntityOfPage' => ['@id' => $webpageId],
            ]);
        } elseif ($record instanceof Service) {
            $graph[] = [
                '@type' => 'Service',
                '@id' => $canonical.'#service',
                'name' => $record->title,
                'description' => $description,
                'provider' => ['@id' => $organisationId],
                'url' => $canonical,
            ];
        } elseif ($record instanceof Program) {
            $graph[] = [
                '@type' => 'Course',
                '@id' => $canonical.'#course',
                'name' => $record->title,
                'description' => $description,
                'provider' => ['@id' => $organisationId],
                'url' => $canonical,
            ];
        } elseif ($record instanceof CaseStudy) {
            $graph[] = array_filter([
                '@type' => 'Article',
                '@id' => $canonical.'#case-study',
                'headline' => $record->title,
                'description' => $description,
                'image' => $image,
                'datePublished' => $record->published_at?->toIso8601String(),
                'dateModified' => $record->updated_at?->toIso8601String(),
                'publisher' => ['@id' => $organisationId],
                'mainEntityOfPage' => ['@id' => $webpageId],
            ]);
        }

        if ($faqs !== []) {
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $canonical.'#faq',
                'mainEntity' => array_map(fn (object $faq): array => [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq->answer)],
                ], $faqs),
            ];
        }

        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'image' => $image,
            'imageAlt' => $title.' — School House Consult',
            'imageWidth' => $imageWidth,
            'imageHeight' => $imageHeight,
            'imageType' => $imageType,
            'type' => $record instanceof Article || $record instanceof CaseStudy ? 'article' : 'website',
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'schema' => ['@context' => 'https://schema.org', '@graph' => $graph],
        ];
    }

    private static function absoluteImage(string $image): string
    {
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            $imageHost = parse_url($image, PHP_URL_HOST);
            $requestHost = request()->getHost();
            $path = parse_url($image, PHP_URL_PATH);
            if ($imageHost !== $requestHost || (is_string($path) && is_file(public_path(ltrim($path, '/'))))) {
                return $image;
            }

            return asset('images/social-card.png');
        }

        $relativePath = ltrim($image, '/');
        if (! is_file(public_path($relativePath))) {
            $relativePath = 'images/social-card.png';
        }

        return asset($relativePath);
    }

    /**
     * @return array{0: int, 1: int, 2: string}
     */
    private static function imageDetails(string $image): array
    {
        $path = parse_url($image, PHP_URL_PATH);
        $absolutePath = is_string($path) ? public_path(ltrim($path, '/')) : '';
        $details = is_file($absolutePath) ? @getimagesize($absolutePath) : false;

        if ($details === false) {
            return [1200, 630, 'image/png'];
        }

        return [$details[0], $details[1], $details['mime'] ?? 'image/png'];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private static function breadcrumbs(string $routeName, string $canonical, string $title): array
    {
        $parents = [
            'services.index' => ['Services', route('services.index')],
            'services.show' => ['Services', route('services.index')],
            'programs.index' => ['Programmes', route('programs.index')],
            'programs.show' => ['Programmes', route('programs.index')],
            'resources.index' => ['Resources', route('resources.index')],
            'resources.show' => ['Resources', route('resources.index')],
            'case-studies.index' => ['Case studies', route('case-studies.index')],
            'case-studies.show' => ['Case studies', route('case-studies.index')],
        ];
        $items = [[
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => route('home'),
        ]];

        if (isset($parents[$routeName]) && $parents[$routeName][1] !== $canonical) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => count($items) + 1,
                'name' => $parents[$routeName][0],
                'item' => $parents[$routeName][1],
            ];
        }

        if ($routeName !== 'home') {
            $items[] = [
                '@type' => 'ListItem',
                'position' => count($items) + 1,
                'name' => $title,
                'item' => $canonical,
            ];
        }

        return $items;
    }
}
