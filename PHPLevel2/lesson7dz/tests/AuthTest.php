<?php

final class AuthTest extends \PHPUnit\Framework\TestCase
{
    public function testLogin()
    {
        $auth = $this->getAuthMock();

        $auth::login('admin');

        $user = $_SESSION['user'];
        $this->assertEquals(123, $user['id']);
        $this->assertEquals([123], $user['roles']);
    }

    private function getAuthMock()
    {
        return new class extends \MyApp\Auth {
            public static function getUsersModel()
            {
                return new class extends \MyApp\Models\Users {
                    public static function get($login) {
                        return [
                            'id' => 123,
                        ];
                    }
                    public static function getRoles($userId) {
                        return [$userId];
                    }
                };
            }
        };
    }

    public function testLogout()
    {
        $expectedBasket = [
            'count' => 0,
            'goods' => [],
        ];

        $_SESSION['user'] = 'admin';
        $_SESSION['basket'] = ['count' => 123];

        \MyApp\Auth::logout();

        $this->assertNull($_SESSION['user']);
        $this->assertEquals($expectedBasket, $_SESSION['basket']);
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
            [ [1,2], 3, false ],
            [ [1,2], 2, true ],
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

        $this->assertEquals(2, $_SESSION['basket']['count']);
        $this->assertEquals(1, $_SESSION['basket']['goods'][123]);
        $this->assertEquals(1, $_SESSION['basket']['goods'][321]);
    }

    /**
     * @dataProvider initBasketProvider
     */
    public function testInitBasket($force, $basket, $expectedBasket)
    {
        $_SESSION['basket'] = $basket;

        if ($force) {
            \MyApp\Auth::clearBasket();
            $actualBasket = $_SESSION['basket'];
        } else {
            $actualBasket = \MyApp\Auth::getBasket();
        }

        $this->assertEquals($expectedBasket, $actualBasket);
    }

    public function initBasketProvider()
    {
        $emptyBasket = [
            'count' => 0,
            'goods' => [],
        ];

        return [
            [true, [], $emptyBasket],
            [true, ['count' => 123], $emptyBasket],
            [false, [], $emptyBasket],
            [false, ['count' => 123], ['count' => 123]],
        ];
    }
}
