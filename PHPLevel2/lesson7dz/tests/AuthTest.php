<?php

final class AuthTest extends \PHPUnit\Framework\TestCase
{
    public function testLogin()
    {
        $auth = $this->getAuthMock();
        $auth::login('admin');

        $user = $_SESSION['user'];
        $this->assertEquals(123, $user['id']);
        $this->assertEquals('admin', $user['login']);
        $this->assertEquals([123], $user['roles']);
    }

    private function getAuthMock()
    {
        return new class extends \MyApp\Auth {
            protected static function getUsersModel(): \MyApp\Models\Users
            {
                return new class extends \MyApp\Models\Users {
                    public static function get($login)
                    {
                        return [
                            'id' => 123,
                            'login' => $login,
                        ];
                    }

                    public static function getRoles($userId)
                    {
                        return [$userId];
                    }
                };
            }
        };
    }

    public function testLogout()
    {
        $_SESSION['user'] = 'admin';
        $_SESSION['basket'] = ['count' => 3];

        \MyApp\Auth::logout();

        $this->assertNull($_SESSION['user']);
        $this->assertEquals(0, $_SESSION['basket']['count']);
    }

    /**
     * @dataProvider hasRoleProvider
     * @param $roles
     * @param $role
     * @param $expected
     */
    public function testHasRole($roles, $role, $expected)
    {
        $_SESSION['user']['roles'] = $roles;

        $this->assertEquals($expected, \MyApp\Auth::hasRole($role));
    }

    public function hasRoleProvider()
    {
        return [
            [ [], 1, false ],
            [ [1, 2], 3, false ],
            [ [1, 2], 2, true ],
        ];
    }

    public function testGetUser()
    {
        $_SESSION['user'] = 'admin';

        $this->assertEquals('admin', \MyApp\Auth::getUser());
    }

    public function testAddToBasket()
    {
        \MyApp\Auth::clearBasket();
        \MyApp\Auth::addToBasket(123);
        \MyApp\Auth::addToBasket(321);
        $basket = \MyApp\Auth::getBasket();

        $this->assertEquals(2, $basket['count']);
        $this->assertEquals(1, $basket['goods'][123]);
        $this->assertEquals(1, $basket['goods'][321]);
    }

    /**
     * @dataProvider initBasketProvider
     */
    public function testInitBasket($force, $initialBasket, $expectedBasket)
    {
        $_SESSION['basket'] = $initialBasket;

        if ($force) {
            \MyApp\Auth::clearBasket();
            $basket = $_SESSION['basket'];
        } else {
            $basket = \MyApp\Auth::getBasket();
        }

        $this->assertEquals($expectedBasket, $basket);
    }

    public function initBasketProvider()
    {
        $cleanBasket = [
            'count' => 0,
            'goods' => [],
        ];

        return [
            [true, ['count' => 1], $cleanBasket],
            [false, ['count' => 1], ['count' => 1]],
            [true, null, $cleanBasket],
            [false, null, $cleanBasket],
        ];
    }
}