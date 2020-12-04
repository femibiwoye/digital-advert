<?php
namespace frontend\components;

use yii\base\Widget;

class SendEmail extends Widget
{
    public $template = '';
    public $to;
    public $from='support';
    public $subject;
    public $body = '';
    public $data = [];

    public function init()
    {
        parent::init();
        if (empty($this->template)) {
            $mail = \Yii::$app->mailer->compose();
        } else {
            $mail = \Yii::$app->mailer->compose(['html' => $this->template],['data'=>$this->data]);
        }
        $mail->setFrom([\Yii::$app->params[$this->from.'Email'] => \Yii::$app->name])
            ->setTo($this->to)
            ->setSubject($this->subject);
        if (!empty($this->body)) {
            $mail->setHtmlBody($this->body);
        }
        return $this->template = $mail->send();
    }

    public function run()
    {
        return $this->template;
    }
}