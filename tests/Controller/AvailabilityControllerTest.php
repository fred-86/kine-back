<?php

namespace App\Test\Controller\Back;

use App\Entity\Back\Availability;
use App\Repository\AvailabilityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvailabilityControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AvailabilityRepository $repository;
    private string $path = '/back/availability/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Availability::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Availability index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'availability[reason]' => 'Testing',
            'availability[startTime]' => 'Testing',
            'availability[endTime]' => 'Testing',
            'availability[recurrence]' => 'Testing',
            'availability[recurrenceDays]' => 'Testing',
            'availability[isWorkingHours]' => 'Testing',
            'availability[daysOfWeeks]' => 'Testing',
            'availability[createdAt]' => 'Testing',
            'availability[updatedAt]' => 'Testing',
            'availability[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/back/availability/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Availability();
        $fixture->setReason('My Title');
        $fixture->setStartTime('My Title');
        $fixture->setEndTime('My Title');
        $fixture->setRecurrence('My Title');
        $fixture->setRecurrenceDays('My Title');
        $fixture->setIsWorkingHours('My Title');
        $fixture->setDaysOfWeeks('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Availability');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Availability();
        $fixture->setReason('My Title');
        $fixture->setStartTime('My Title');
        $fixture->setEndTime('My Title');
        $fixture->setRecurrence('My Title');
        $fixture->setRecurrenceDays('My Title');
        $fixture->setIsWorkingHours('My Title');
        $fixture->setDaysOfWeeks('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'availability[reason]' => 'Something New',
            'availability[startTime]' => 'Something New',
            'availability[endTime]' => 'Something New',
            'availability[recurrence]' => 'Something New',
            'availability[recurrenceDays]' => 'Something New',
            'availability[isWorkingHours]' => 'Something New',
            'availability[daysOfWeeks]' => 'Something New',
            'availability[createdAt]' => 'Something New',
            'availability[updatedAt]' => 'Something New',
            'availability[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/back/availability/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getReason());
        self::assertSame('Something New', $fixture[0]->getStartTime());
        self::assertSame('Something New', $fixture[0]->getEndTime());
        self::assertSame('Something New', $fixture[0]->getRecurrence());
        self::assertSame('Something New', $fixture[0]->getRecurrenceDays());
        self::assertSame('Something New', $fixture[0]->getIsWorkingHours());
        self::assertSame('Something New', $fixture[0]->getDaysOfWeeks());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Availability();
        $fixture->setReason('My Title');
        $fixture->setStartTime('My Title');
        $fixture->setEndTime('My Title');
        $fixture->setRecurrence('My Title');
        $fixture->setRecurrenceDays('My Title');
        $fixture->setIsWorkingHours('My Title');
        $fixture->setDaysOfWeeks('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/back/availability/');
    }
}
