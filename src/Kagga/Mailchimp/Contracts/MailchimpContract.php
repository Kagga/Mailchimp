<?php


namespace Kagga\Mailchimp;


interface MailchimpContract
{
    /**Subscribe users to a list.
     *
     * @param $listName
     * @param $email
     * @return mixed
     */
    public function subscribeTo($listName, $email);


    /**UnSubscribe users from a list.
     * @param $list
     * @param $email
     * @return mixed
     */
    public function unSubscribeFrom($list, $email);

}