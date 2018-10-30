<?php


use Phinx\Seed\AbstractSeed;

class PetitionRecipientsGroupSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'petition_uid' => 'petition-001',
                'petition_translation_uid' => 'petition-translation-001',
                'recipient_group_uid' => 'recipient-group-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-001',
                'petition_translation_uid' => 'petition-translation-002',
                'recipient_group_uid' => 'recipient-group-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-001',
                'petition_translation_uid' => 'petition-translation-003',
                'recipient_group_uid' => 'recipient-group-002',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-001',
                'petition_translation_uid' => 'petition-translation-004',
                'recipient_group_uid' => 'recipient-group-004',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-001',
                'petition_translation_uid' => 'petition-translation-005',
                'recipient_group_uid' => 'recipient-group-003',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-002',
                'petition_translation_uid' => 'petition-translation-006',
                'recipient_group_uid' => 'recipient-group-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-002',
                'petition_translation_uid' => 'petition-translation-007',
                'recipient_group_uid' => 'recipient-group-001',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-002',
                'petition_translation_uid' => 'petition-translation-008',
                'recipient_group_uid' => 'recipient-group-002',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-002',
                'petition_translation_uid' => 'petition-translation-009',
                'recipient_group_uid' => 'recipient-group-004',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'petition_uid' => 'petition-002',
                'petition_translation_uid' => 'petition-translation-010',
                'recipient_group_uid' => 'recipient-group-003',
                'status'=> 1,
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('petition_recipients_group');
        $table->truncate();
        $table->insert($data)
            ->save();
    }
}
