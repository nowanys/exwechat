<?php
namespace youwen\exwechat\api\message;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 */
class message extends AbstractApi
{
    // 上传图文消息内的图片获取URL【订阅号与服务号认证后均可用】 POST
    private $urlUploadimg = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s';
    // 上传图文消息素材【订阅号与服务号认证后均可用】 POST
    private $urlUploadnews = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=%s';
    // 根据分组进行群发【订阅号与服务号认证后均可用】 POST
    private $urlSendall = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=%s';
    // 上传视频 POST (群发)
    private $urlUploadvideo = 'https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=%s';
    // 根据OpenID列表群发【订阅号不可用，服务号认证后可用】 POST
    private $urlSend = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=%s';
    // 上传视频 POST (根据openid发)
    private $urlVideo = 'https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=%s';
    // 删除群发【订阅号与服务号认证后均可用】 POST
    private $urlDelete = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=%s';
    // 预览接口【订阅号与服务号认证后均可用】 POST  限制（100次），请勿滥用
    private $urlPreview = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=%s';
    // 查询群发消息发送状态【订阅号与服务号认证后均可用】 POST
    private $urlGet = 'https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    public function uploadimg($img='')
    {
    	$url = sprintf($this->urlUploadimg, $this->token);
        // $file = $_SERVER['DOCUMENT_ROOT'] . ltrim($matinfo['localpath'], '.');
        // $file = realpath('./Uploads/wechatpic/sys/53abe32d5b8d8.jpeg');
        $file = str_replace("\\", "/", realpath($img));
        $data = array();
        // $data['media'] = '@'.$file;  //php5.5前
        $data['media'] = new \CURLFile($file); // php5.5后
    	$ret = http::curl_post($url, $data);
    	return $this->commenPart($ret);
    }

    public function uploadnews($data)
    {
        $url = sprintf($this->urlUploadnews, $this->token);
        $json = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

    public function sendall($data)
    {
        $url = sprintf($this->urlUploadnews, $this->token);
        $json = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

    public function send($data)
    {
        $url = sprintf($this->urlSend, $this->token);
        $json = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }


}
