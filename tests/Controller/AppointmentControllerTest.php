<?php

namespace App\Test\Controller\Back;

use App\Entity\Back\Appointment;
use App\Repository\Back\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppointmentControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AppointmentRepository $repository;
    private string $path = '/back/appointment/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Appointment::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appointment index');

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
            'appointment[date]' => 'Testing',
            'appointment[time]' => 'Testing',
            'appointment[topic]' => 'Testing',
            'appointment[comment]' => 'Testing',
            'appointment[notification]' => 'Testing',
            'appointment[createdAt]' => 'Testing',
            'appointment[updatedAt]' => 'Testing',
            'appointment[user]' => 'Testing',
            'appointment[status]' => 'Testing',
            'appointment[patient]' => 'Testing',
        ]);

        self::assertResponseRedirects('/back/appointment/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appointment();
        $fixture->setDate('My Title');
        $fixture->setTime('My Title');
        $fixture->setTopic('My Title');
        $fixture->setComment('My Title');
        $fixture->setNotification('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');
        $fixture->setStatus('My Title');
        $fixture->setPatient('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appointment');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appointment();
        $fixture->setDate('My Title');
        $fixture->setTime('My Title');
        $fixture->setTopic('My Title');
        $fixture->setComment('My Title');
        $fixture->setNotification('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');
        $fixture->setStatus('My Title');
        $fixture->setPatient('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'appointment[date]' => 'Something New',
            'appointment[time]' => 'Something New',
            'appointment[topic]' => 'Something New',
            'appointment[comment]' => 'Something New',
            'appointment[notification]' => 'Something New',
            'appointment[createdAt]' => 'Something New',
            'appointment[updatedAt]' => 'Something New',
            'appointment[user]' => 'Something New',
            'appointment[status]' => 'Something New',
            'appointment[patient]' => 'Something New',
        ]);

        self::assertResponseRedirects('/back/appointment/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getTime());
        self::assertSame('Something New', $fixture[0]->getTopic());
        self::assertSame('Something New', $fixture[0]->getComment());
        self::assertSame('Something New', $fixture[0]->getNotification());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getPatient());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Appointment();
        $fixture->setDate('My Title');
        $fixture->setTime('My Title');
        $fixture->setTopic('My Title');
        $fixture->setComment('My Title');
        $fixture->setNotification('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');
        $fixture->setStatus('My Title');
        $fixture->setPatient('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/back/appointment/');
    }
}
