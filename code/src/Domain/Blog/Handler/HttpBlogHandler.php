<?php

declare(strict_types=1);

namespace App\Domain\Blog\Handler;

use App\Entity\Blog;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HttpBlogHandler //implements BlogHandlerInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly SluggerInterface $slugger,
        #[Autowire(param: 'app.api.blog_endpoint')]
        private readonly string $apiBaseUrl,
    ) {

    }

    public function add(Blog $blog): void
    {
        // TODO Completer cette methode pour implémenter la communication avec l'API
        $response = $this->httpClient->request('POST', $this->apiBaseUrl.'/blogs', [
            'body' => [
                'title' => $blog->getTitle(),
                // ... other fields
            ],
        ]);

        $this->doGenerateSlug($blog);
    }

    public function edit(Blog $blog): void
    {
        // TODO Completer cette methode pour implémenter la communication avec l'API
        $response = $this->httpClient->request('PUT', $this->apiBaseUrl.'/blogs', [
            'body' => [
                'title' => $blog->getTitle(),
                // ... other fields
            ],
        ]);

        $this->doGenerateSlug($blog);
    }

    private function doGenerateSlug(Blog $blog): void
    {
        // compute the slug for example
        $slug = \strtolower($this->slugger->slug($blog->getTitle())->toString());

        $blog->setSlug($slug);
    }
}
