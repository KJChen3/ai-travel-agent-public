<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Insert sample data
        // \DB::table('products')->insert([
         $products = [
        [
                'name' => '九份老街',
                'content' => '<p><b>九份老街</b><br>
    走進九份老街，彷彿踏上了一場時光之旅。這裡是臺灣懷舊文化的縮影，充滿獨特的歷史風貌與迷人的山城景緻。<br>
    蜿蜒的石板路、紅燈籠點綴的茶樓，以及琳瑯滿目的特色小吃，吸引著無數旅客慕名而來。</p>

    <p><b>為什麼一定要來九份老街？</b></p>
    <p><b>1. 古樸街道，充滿歷史氣息</b><br>
    九份因金礦開採而興起，至今仍保留著日治時期的建築風貌。走在老街上，感受歲月的痕跡與濃厚的人文氛圍。</p>

    <p><b>2. 地道美食，滿足味蕾</b><br>
    來到九份，怎能錯過著名的芋圓、紅糟肉圓、草仔粿和魚丸湯？每一口都是地道的台灣風味。</p>

    <p><b>3. 迷人的山海景觀</b><br>
    九份地處山腰，可俯瞰基隆港和太平洋的壯麗景色。無論是晨曦還是夜幕，這裡都能帶給您最震撼的視覺享受。</p>

    <p><b>4. 茶樓文化，細品時光</b><br>
    著名的阿妹茶樓和其他古色古香的茶館，是品茗放鬆的絕佳去處。挑一個角落坐下，欣賞美景，感受慢生活。</p>

    <p><b>5. 《千與千尋》的靈感之地</b><br>
    九份老街以其獨特的燈籠和茶樓，據說是宮崎駿動畫《千與千尋》中湯屋的靈感來源，讓人倍感熟悉與夢幻。</p>',
                'price' => 500,
                'rate' => 4.5,
                'picture1' => 'Jiufen-1.jpg',
                'picture2' => 'Jiufen-2.jpg',
                'picture3' => 'Jiufen-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '台北 101',
                'content' => '台北101，是台北的城市地標，融合東方文化與現代建築之美。這座摩天大樓不僅是工程技術的奇蹟，更是觀景、美食與購物的最佳去處。</p>

<p><b>為什麼一定要來台北101？</b></p>
<p><b>世界級的觀景台</b><br>
搭乘高速電梯到89樓觀景台，俯瞰整個台北市，白天和夜晚的景色都令人驚嘆。</p>

<p><b>國際品牌購物天堂</b><br>
101購物中心匯聚奢華品牌與台灣特色商店，滿足購物愛好者的多元需求。</p>

<p><b>特色餐飲選擇</b><br>
從米其林餐廳到地道台灣小吃，101內外匯聚多樣化的美食選擇，讓你盡享饗宴。</p>

<p><b>跨年煙火盛會</b><br>
台北101的跨年煙火是全球矚目的盛事，每年的創意表演都吸引無數觀眾。</p>

<p><b>創新建築設計</b><br>
大樓採用如竹節般的結構象徵節節高升，內部的阻尼器更是建築與科技結合的代表，展現工程奇蹟的魅力。</p>',
                'price' => 800,
                'rate' => 4.8,
                'picture1' => '101-1.jpg',
                'picture2' => '101-2.png',
                'picture3' => '101-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '北投溫泉',
                'content' => '北投溫泉是台北最具特色的天然溫泉區，以其豐富的地熱資源與療癒功能聞名於世。這裡還保留了濃厚的日式溫泉文化，是放鬆身心、感受歷史與自然的絕佳選擇。</p>

<p><b>為什麼一定要來北投溫泉？</b></p>
<p><b>多樣化的溫泉體驗</b><br>
北投溫泉擁有多種泉質，如白磺泉與碳酸泉，對舒緩疲勞和促進健康都有顯著效果。</p>

<p><b>日式建築的文化氛圍</b><br>
從北投溫泉博物館到新北投車站，這些日治時期的建築展現了溫泉區的悠久歷史與懷舊風情。</p>

<p><b>地熱谷的壯觀景象</b><br>
地熱谷冒出的蒸汽與高溫泉水宛如仙境，是瞭解北投地質特色與自然奇觀的必訪地點。</p>

<p><b>北投公園的自然景致</b><br>
環繞溫泉區的北投公園，提供寧靜的步道與豐富的植物景觀，是親近自然的好地方。</p>

<p><b>精緻溫泉飯店與湯屋</b><br>
無論是高檔溫泉飯店還是傳統湯屋，都能為旅客提供高品質的住宿與泡湯享受。</p>',
                'price' => 1800,
                'rate' => 4.6,
                'picture1' => 'Beitou-1.jpg',
                'picture2' => 'Beitou-2.jpg',
                'picture3' => 'Beitou-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '臺灣大學',
                'content' => '臺灣大學，位於臺北市中心，是臺灣歷史最悠久且享譽國際的頂尖學府。不僅是高等教育的重要象徵，台大的校園本身更是結合了知性與美景的絕佳旅遊景點，吸引許多觀光客前來參觀。</p>

    <p><b>台大的必訪亮點</b></p>
    <p><b>1. 縱橫百年的歷史軌跡</b><br>
    成立於1928年的臺灣大學，前身為日治時期的臺北帝國大學。校園中仍保留多座極具歷史意義的建築，述說著時代的變遷。</p>

    <p><b>2. 知名的椰林大道</b><br>
    進入校園，首先映入眼簾的便是象徵台大的椰林大道。這條綠意盎然的筆直道路，兩旁高聳的椰子樹成為拍照打卡的熱門景點。<br>
    大道盡頭是台大的標誌性建築── 傅鐘與校本部大樓。</p>

    <p><b>3. 壯麗的總圖書館</b><br>
    臺灣大學總圖書館融合了傳統與現代建築風格，是校園裡最具學術氛圍的地方。館內藏書豐富，是臺灣知識的寶庫。</p>

    <p><b>4. 自然與人文的交融</b><br>
    台大校園內的綠地與生態資源豐富，像是醉月湖、小椰林及各式植物園，讓人彷彿置身於大自然中，適合漫步與放鬆。</p>

    <p><b>5. 豐富的博物館群</b><br>
    校園內擁有多個學術博物館，如台大地質標本館、台大動物標本館與台大人類學博物館，展示各領域的珍貴研究成果，增添參觀的趣味。</p>',
                'price' => 0,
                'rate' => 4.7,
                'picture1' => 'NTU-1.jpg',
                'picture2' => 'NTU-2.jpg',
                'picture3' => 'NTU-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '松山文創圓區',
                'content' => '松菸園區位於臺北市信義區，是一個結合了藝術、文化與創意的綜合性園區。原本是台灣菸酒公司的製煙工廠，經過整修後，成功轉型為一個文化創意產業的聚集地，吸引了各式藝術展覽、手作市集、餐飲文化等活動。松菸園區的歷史建築與現代設施相互融合，成為臺北市民休閒與創意交流的熱點之一。</p>

    <p><b>松菸園區的必訪亮點</b></p>
    <p><b>1. 藝術與展覽空間</b><br>
    松菸園區內擁有多個藝術展覽空間，如松山文創大樓，定期舉辦藝術展覽、設計市集和各式創意活動，是喜愛藝術和文化的遊客必訪之地。</p>

    <p><b>2. 特色文創商店</b><br>
    園區內聚集了許多文創商店，販售手作商品、設計產品、書籍與各式紀念品。可以在這裡尋找富有創意的禮物和紀念品，體驗創意與設計的魅力。</p>

    <p><b>3. 綠意盎然的休憩空間</b><br>
    松菸園區內有許多綠地和戶外空間，適合放鬆、散步或進行社交活動。園區內的綠意和藝術氛圍，使其成為都市中的一個靜謐角落。</p>

    <p><b>4. 餐飲與咖啡文化</b><br>
    園區內設有多家特色餐廳和咖啡館，提供創意料理、手沖咖啡和甜點。這些餐廳不僅有美味的食物，還有獨特的設計和環境，是聚會或悠閒午後的好去處。</p>

    <p><b>5. 歷史與文化的融合</b><br>
    作為昔日的製煙工廠，松菸園區保留了許多歷史建築，這些建築與現代化設施並存，展現了台灣歷史與現代創意產業的融合。遊客可以在此感受到歷史的痕跡與現代文化的碰撞。</p>',
                'price' => 500,
                'rate' => 4.3,
                'picture1' => 'Songshan-1.jpg',
                'picture2' => 'Songshan-2.jpg',
                'picture3' => 'Songshan-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '淡水',
                'content' => '淡水位於台北的西北角，是融合自然景觀與人文歷史的魅力小鎮。河岸的浪漫夕陽、美食與古蹟，吸引著來自世界各地的旅客，是探索台北文化的最佳起點。</p>

<p><b>為什麼一定要來淡水？</b></p>
<p><b>浪漫夕陽美景</b><br>
淡水河畔的落日被譽為世界最美的夕陽之一，傍晚時分漫步河岸，畫面如詩如畫。</p>

<p><b>豐富的歷史文化</b><br>
紅毛城、小白宮和真理大學等歷史建築，讓人輕鬆感受淡水多元的文化與時代風貌。</p>

<p><b>淡水老街的地道美食</b><br>
阿給、鐵蛋、魚酥等小吃多不勝數，無論是輕鬆小酌還是尋找台灣經典風味，老街都能滿足味蕾。</p>

<p><b>漁人碼頭的浪漫氣氛</b><br>
情人橋和海港景致讓漁人碼頭成為拍照打卡和約會的熱門地點，夜晚更顯迷人。</p>

<p><b>水上活動與自然探索</b><br>
可參加河上遊船，享受不同角度的淡水美景，或探索鄰近的八里左岸，體驗悠閒氛圍。</p>',
                'price' => 400,
                'rate' => 4.2,
                'picture1' => 'Tamsui-1.jpg',
                'picture2' => 'Tamsui-2.jpg',
                'picture3' => 'Tamsui-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '陽明山',
                'content' => '陽明山是臺北市區內的一個自然寶藏，也是台灣著名的國家公園之一。以其壯麗的山脈、豐富的自然資源以及四季變換的美景，成為都市居民放鬆身心的好去處。春天的櫻花、夏天的涼風、秋冬的溫泉，讓這裡一年四季皆充滿魅力。</p>

    <p><b>陽明山的必訪亮點</b></p>
    <p><b>1. 壯麗的山岳景觀</b><br>
    陽明山擁有雄偉的火山山脈與迷人的自然景色，讓人徹底放鬆。走上山巔，您可以一覽臺北盆地的全景。</p>

    <p><b>2. 四季如畫的花卉</b><br>
    春天是陽明山的花季，櫻花、杜鵑花等競相綻放，讓整個山區變成繽紛的花海。</p>

    <p><b>3. 獨特的硫磺泉</b><br>
    陽明山地處火山帶，擁有豐富的硫磺泉。遊客可以在山區的溫泉中浸泡，享受放鬆身心的愉悅。</p>

    <p><b>4. 眾多的健行步道</b><br>
    無論是輕鬆散步還是挑戰健行，陽明山提供多條步道，讓喜愛大自然的人士有各種選擇。</p>

    <p><b>5. 文化與歷史遺跡</b><br>
    陽明山不僅是自然景點，還擁有多個歷史文化遺跡，如陽明書院，在享受自然景色的同時，也能了解台灣的歷史文化。</p>',
                'price' => 800,
                'rate' => 4.4,
                'picture1' => 'YangMing-1.png',
                'picture2' => 'YangMing-2.jpg',
                'picture3' => 'YangMing-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
    }
}
