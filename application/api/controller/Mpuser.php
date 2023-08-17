<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Validate;
use fast\Random;
use app\common\library\Token;


class Mpuser extends Api
{
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['login'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test'];

    public function login()
    {
        $post = $this->request->post();

        $rule = [
            'openid' => 'require|length:10,30'
        ];

        $msg = [
            'openid.require' => "缺少openid",
            'openid.length' => 'openid长度不符合'
        ];

        $v = new Validate($rule, $msg);

        if (!$v->check($post)) {
            $this->error('登录失败: ' . $v->getError());
        }

        $u = model('admin/User')->where('openid', $post["openid"])->find();

        if ($u) {
            // 执行登录
            Token::clear($u["id"]);
            $this->auth->direct($u["id"]);
            $this->success('登录成功', $this->auth->getUserinfo());
        } else {
            // 执行注册
            $username = $post['openid'];
            // 初始化密码给个随机数
            $password = Random::alnum(15);
            $this->auth->register($username, $password, '', '', [
                "openid" => $post["openid"]
            ]);
            $this->success("注册成功", $this->auth->getUserinfo());
        }
    }

    public function test()
    {
        // 95cd2235-cec6-49c4-a964-7c90dc92c3e8
        $this->success('成功', $this->auth->getUserinfo());
    }
}
