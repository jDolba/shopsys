<?php

namespace Shopsys\FrameworkBundle\Component\Elasticsearch;

use Elasticsearch\Client;
use Shopsys\FrameworkBundle\Component\Domain\Domain;
use Shopsys\FrameworkBundle\Component\Elasticsearch\Exception\DefinitionNotFoundException;
use Shopsys\FrameworkBundle\Component\Elasticsearch\Exception\ElasticsearchStructureException;
use Shopsys\FrameworkBundle\Component\Elasticsearch\Exception\InvalidJsonException;
use Symfony\Component\Console\Output\OutputInterface;

class ElasticsearchStructureFacade
{
    /**
     * @var string
     */
    protected $definitionDirectory;

    /**
     * @var \Elasticsearch\Client
     */
    protected $client;

    /**
     * @var \Shopsys\FrameworkBundle\Component\Domain\Domain
     */
    protected $domain;

    /**
     * @param string $definitionDirectory
     * @param \Elasticsearch\Client $client
     * @param \Shopsys\FrameworkBundle\Component\Domain\Domain $domain
     */
    public function __construct(string $definitionDirectory, Client $client, Domain $domain)
    {
        $this->definitionDirectory = $definitionDirectory;
        $this->client = $client;
        $this->domain = $domain;
    }


    public function createIndexes(OutputInterface $output) {
        foreach ($this->domain->getAllIds() as $id) {
            $output->writeln(sprintf('Creating index for id %s', $id));
            $definition = $this->getDefinition($id);
            $indices = $this->client->indices();
            $indices->create([
                'index' => (string) $id,
                'body' => $definition,
            ]);
            $output->writeln('Index created');
        }
    }

    public function dropIndexes(OutputInterface $output) {

    }

    /**
     * @param int $id
     * @return array
     */
    protected function getDefinition(int $id): array
    {
        $file = sprintf('%s/%s.json', $this->definitionDirectory, $id);
        if (!is_file($file)) {
            throw new ElasticsearchStructureException(sprintf('File %s not found', $file));
        }
        $json = file_get_contents($file);

        $definition = json_decode($json, JSON_OBJECT_AS_ARRAY);
        if ($definition === null) {
            throw new ElasticsearchStructureException(sprintf('Invalid JSON format in file %s', $file));
        }

        return $definition;
    }

}
