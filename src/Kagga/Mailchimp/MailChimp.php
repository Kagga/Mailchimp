<?php


namespace Kagga\MailChimp;

use NZTim\Mailchimp\Mailchimp as Chimp;
use NZTim\Mailchimp\MailchimpException;

class MailChimp extends chimp
{

    /**Un subscribe a user from a list.
     * @param $listId
     * @param $emailAddress
     * @param array $mergeFields
     * @throws MailchimpException
     */
    public function unsubscribe($listId, $emailAddress, $mergeFields = [])
    {
        // Check the list exists
        if (!$this->checkListExists($listId)) {
            throw new MailchimpException('subscribe called on list that does not exist: ' . $listId);
        }

        $id = md5(strtolower($emailAddress));
        $endpoint = "lists/{$listId}/members/{$id}";

        $data = [
            'email_address' => $emailAddress,
            'status' => "unsubscribed"
        ];
        if (!empty($mergeFields)) {
            $data['merge_fields'] = $mergeFields;
        }
        $response = $this->callApi('patch', $endpoint, $data);
        if (empty($response['status']) || !in_array($response['status'], ['subscribed', 'pending', 'unsubscribed'])) {
            throw new MailchimpException('unsubscribe received unexpected response from DrewMMailchimp: ' . json_encode($response));
        }
    }
}