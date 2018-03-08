<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Tests\Functional\Bundle\BenchmarkBundle\Providers;

use PHPUnit_Framework_Constraint_IsType as IsType;

class CategoriesProviderTest extends ProviderTestCase
{
    const SERVICE_ID = 'shopware.benchmark_bundle.providers.categories';
    const EXPECTED_KEYS_COUNT = 3;
    const EXPECTED_TYPES = [
        'total' => IsType::TYPE_INT,
        'maxLevels' => IsType::TYPE_INT,
        'products' => [
            'average' => IsType::TYPE_FLOAT,
            'max' => IsType::TYPE_INT,
        ],
    ];

    /**
     * @group BenchmarkBundle
     */
    public function testGetTotalCategoriesAndMaxLevels()
    {
        $this->installDemoData('categories');

        $provider = $this->getProvider();

        $resultData = $provider->getBenchmarkData();

        $this->assertSame(5, $resultData['total']);
        $this->assertSame(6, $resultData['maxLevels']);
    }

    /**
     * @group BenchmarkBundle
     */
    public function testGetAverageProductsPerCategory()
    {
        $this->installDemoData('category_products');

        $provider = $this->getProvider();

        $resultData = $provider->getBenchmarkData();

        $this->assertSame(4.0, $resultData['products']['average']);
    }

    /**
     * @group BenchmarkBundle
     */
    public function testGetMaxProductsPerCategory()
    {
        $this->installDemoData('category_products');

        $provider = $this->getProvider();

        $resultData = $provider->getBenchmarkData();

        $this->assertSame(7, $resultData['products']['max']);
    }
}
