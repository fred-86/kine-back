<?php

namespace App\Test\Controller\Back;

use App\Entity\Back\Availability;
use App\Repository\AvailabilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvailabilityControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/back/availability/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Availability::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
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
            'availability[backgroundColor]' => 'Testing',
            'availability[textColor]' => 'Testing',
            'availability[borderColor]' => 'Testing',
            'availability[allDay]' => 'Testing',
            'availability[pratictioner]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
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
        $fixture->setBackgroundColor('My Title');
        $fixture->setTextColor('My Title');
        $fixture->setBorderColor('My Title');
        $fixture->setAllDay('My Title');
        $fixture->setPratictioner('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Availability');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Availability();
        $fixture->setReason('Value');
        $fixture->setStartTime('Value');
        $fixture->setEndTime('Value');
        $fixture->setRecurrence('Value');
        $fixture->setRecurrenceDays('Value');
        $fixture->setIsWorkingHours('Value');
        $fixture->setDaysOfWeeks('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');
        $fixture->setBackgroundColor('Value');
        $fixture->setTextColor('Value');
        $fixture->setBorderColor('Value');
        $fixture->setAllDay('Value');
        $fixture->setPratictioner('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

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
            'availability[backgroundColor]' => 'Something New',
            'availability[textColor]' => 'Something New',
            'availability[borderColor]' => 'Something New',
            'availability[allDay]' => 'Something New',
            'availability[pratictioner]' => 'Something New',
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
        self::assertSame('Something New', $fixture[0]->getBackgroundColor());
        self::assertSame('Something New', $fixture[0]->getTextColor());
        self::assertSame('Something New', $fixture[0]->getBorderColor());
        self::assertSame('Something New', $fixture[0]->getAllDay());
        self::assertSame('Something New', $fixture[0]->getPratictioner());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Availability();
        $fixture->setReason('Value');
        $fixture->setStartTime('Value');
        $fixture->setEndTime('Value');
        $fixture->setRecurrence('Value');
        $fixture->setRecurrenceDays('Value');
        $fixture->setIsWorkingHours('Value');
        $fixture->setDaysOfWeeks('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');
        $fixture->setBackgroundColor('Value');
        $fixture->setTextColor('Value');
        $fixture->setBorderColor('Value');
        $fixture->setAllDay('Value');
        $fixture->setPratictioner('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/back/availability/');
        self::assertSame(0, $this->repository->count([]));
    }
}
