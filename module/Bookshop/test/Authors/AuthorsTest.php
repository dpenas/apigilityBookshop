<?php

namespace BookshopTest\Authors;

use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Http\Request;

class AuthorsTest extends AbstractHttpControllerTestCase
{
    private $objectsCreated = [];

    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [
            'module_listener_options' => [
                'config_cache_enabled' => false,
            ],
        ];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function testAuthorsPost()
    {
        $post = json_encode(['name'=> 'AuthorTest', 'bornDate' => '1965-01-01']);

        $request = $this->getRequest();
        $request->setMethod('POST');
        $request->setContent($post);
        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch('/authors');

        $response = json_decode($this->getResponse()->getContent());

        $this->assertEquals('AuthorTest', $response->name);
        $this->assertEquals('1965-01-01 00:00:00.000000', $response->bornDate->date);

        $this->objectsCreated['author'] = $response->id;

        return $response->id;
    }

    /**
     * @depends testAuthorsPost
     *
     * @throws \Exception
     */
    public function testAuthorsPut($authorId)
    {
        $put = json_encode(['name'=> 'AuthorTestNew', 'bornDate' => '1965-01-01']);

        $request = $this->getRequest();
        $request->setMethod('PUT');
        $request->setContent($put);
        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch('/authors/' . $authorId);

        $response = json_decode($this->getResponse()->getContent());

        $this->assertEquals('AuthorTestNew', $response->name);
        $this->assertEquals('1965-01-01 00:00:00.000000', $response->bornDate->date);

        return $authorId;
    }

    public function testAuthorsPostInvalid()
    {
        $post = json_encode(['name'=> 'AuthorTestNew', 'bornDate' => 'incorrectDate']);

        $request = $this->getRequest();
        $request->setMethod('POST');
        $request->setContent($post);
        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch('/authors');

        $response = json_decode($this->getResponse()->getContent());

        $this->assertEquals('The input does not appear to be a valid date', $response->validation_messages->bornDate->dateInvalidDate);
        $this->assertEquals(422, $response->status);
    }

    /**
     * @depends testAuthorsPut
     *
     * @throws \Exception
     */
    public function testBooksPost($authorId)
    {
        $post = json_encode(['title' => 'BookTest', 'releaseDate' => '2018-01-01', 'authors' => ['id' => $authorId]]);

        $request = $this->getRequest();
        $request->setMethod('POST');
        $request->setContent($post);
        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch('/books');

        $response = json_decode($this->getResponse()->getContent());

        $author = $response->_embedded->authors[0];
        $bookId = $response->id;

        $this->assertEquals('BookTest', $response->title);
        $this->assertEquals($authorId, $author->id);
        $this->assertEquals('AuthorTestNew', $author->name);

        $request = $this->getRequest();
        $request->setMethod('DELETE');

        // This would have been better do to in a tearDown or tearDownAfterClass function
        // but due to the conditions of the tests, it's not very easy to do so.
        $this->removeBook($bookId);
        $this->removeAuthor($author->id);
    }

    private function removeAuthor($authorId)
    {
        parent::setUp();

        $this->dispatch('/authors/' . $authorId, Request::METHOD_DELETE);
    }

    private function removeBook($bookId)
    {
        parent::setUp();

        $this->dispatch('/books/' . $bookId, Request::METHOD_DELETE);
    }
}
