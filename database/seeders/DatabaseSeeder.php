<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // dokter seeder
        DB::table('dokter')->insert([
            [
                'id' => 1,
                'nama' => 'DR YOSELYN O',
            ],
            [
                'id' => 2,
                'nama' => 'DR RAHMAT'
            ]
        ]);

        $user = User::create([
            'name' => 'DR RAHMAT',
            'username' => 'rahmat',
            'password' => Hash::make('rahmat')
        ]);

        DB::table('user_role')->insert([
            'user_id' => $user->id,
            'role_id' => 2,
            'type' => "dokter"
        ]);

        DB::table('diagnosa')->insert([
            [
                'id' => "K36.0",
                'nama' => "OTHER APPENDICTIS"
            ],
            [
                'id' => "K37.0",
                'nama' => "AUTISME"
            ],
            [
                'id' => "K38.0",
                'nama' => "DOWN SYNDROME"
            ],
        ]);
        DB::table("tindakan")->insert([
            [
                'id' => "K123.0",
                'nama' => 'RAWAT INAP'
            ],
            [
                'id' => "K124.0",
                'nama' => 'LOBOTOMI'
            ],
            [
                'id' => "K125.0",
                'nama' => 'BEKAM'
            ],
        ]);

        DB::table('laboratorium')->insert([
            [
                'nama' => 'Patologi Klinik'
            ]
        ]);

        DB::table('radiologi')->insert([
            [
                'nama' => 'x-ray'
            ]
        ]);

        DB::table('obat')->insert([
            [
                'nama' => 'TROGYL',
                'sediaan_obat' => 'TABLET',
                'stok' => 30
            ],
            [
                'nama' => 'AMBROXOL',
                'sediaan_obat' => 'TABLET',
                'stok' => 30
            ]
        ]);

        // pasien seeder
        DB::table('pasien')->insert([
            [
                'no_rm' => 1,
                'nama' => 'Marcellino Mahesa',
                'nama_keluarga' => 'Janitra',
                'nik' => '123456789',
                'no_identitas_lain' => '123',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bekasi',
                'tanggal_lahir' => '2024-10-22',
                'umur' => 12,
                'nama_ibu' => 'Vincent',
                'no_telp' => '123',
                'no_telp_rumah' => '123',
                'agama' => 'Katolik',
                'pendidikan' => 'Belum Sekolah',
                'status_pernikahan' => 'Belum Menikah',
                'gol_darah' => 'A',
                'pekerjaan' => 'Nganggur',
                'suku' => 'Jawa',
                'bahasa' => 'Indo',
                'kewarganegaraan' => 'Indonesia',
                'alamat' => 'keputih',
                'rw' => '1',
                'rt' => '2',
                'kode_pos' => '60111',
                'signature' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAAGr9JREFUeF7tnV/IPsdVx0+xYMQUUmihxYQqtBjRYgveFCKtdwpeRIjQ4EWU9tKLCBEFBc2VSoR42YuWKggNWGi9UkGxpZEUFBqwBcWClhQasNCAgQZaqO9p9iQnk32eZ3d2d2bO2c8DP9739z67OzOfc3a+M2f+vUX4QAACEIAABCoIvKXiHm6BAAQgAAEICAKCE0AAAhCAQBUBBKQKGzdBAAIQgAACgg9AAAIQgEAVAQSkChs3QQACEIAAAoIPQAACEIBAFQEEpAobN0EAAhCAAAKCD0AAAhCAQBUBBKQKGzdBAAIQgAACgg9AAAIQgEAVAQSkChs3QQACEIAAAoIPQAACEIBAFQEEpAobN0EAAhCAAAKCD0AAAhCAQBUBBKQKGzdBAAIQgAACgg9AAAIQgEAVAQSkChs3QQACEIAAAoIPQAACEIBAFQEEpAobN0EAAhCAAAJy3Qd+cvr6f3AVCEAAAhB4IwEE5M0eoaLxmIg8LCIfEJGXROQvRORJnAcCEIAABF4ngIC80Rv+WUQ+csFBtBfyW3fffwEHGpaAiv8ficiDIvKoiNBzHNZUZCwDAQTkdSteEw9v67+ceiNUTmO9ASoez4nIu6ZsvSwi70dExjISuclFAAF51Z7aav1jZ1r7/T9F5KeL7/QyFQ8TklweEbc0cw0A7TGqnfhAAAIHEEBARLTl+t+O7S/NhKn0Gq2gbFDdLlehYWzkAMdc+ciyAWC3a7hR7ckHAhA4gMDZBUQF4V9F5B0TW22taqt17mOD676notfNCc4BpuKRVwj84Mp3R/i4+gIhTFzy9ASOeLkiQfVhj1dE5GcWVAw6yK732Ucrkp+KVOgd8vrpabKBCu5fLWC2Q5JXH6E9yLJ3aDfs6eOaxn+JyPenhsYzRxeM50NgZAJ7vlwjl3Mub1481orAb4qIVqL2udZzicblVn7LcNEI4wyteiCfFJGPOUDacKAncstj+D4tgbMKiK8E14qHOYMKiAqJfc4SyioHq5Wflr1nRdqyB/LvInKvs7uOs2gvTH/2ZJC2kqJg4xI4o4D4ENSWyq8cfP+miDwwrql3y9ncgHXvyQSXBtG10Hv7+KUJFZqWhkE/ISJ/y3qh3fyNBw1MYO+Xa+CivpY134Le2muIFsr63kThr69MFlhiw7LFP8JsJ20Y/IKIPFUU4KgwU9kDLbnZVO8v7iwmKmD6jwWtSzyVaw4lcDYB8RX+Hq3mcvHalh7NoYYWkTJ+r3nVKcj6c21lNLduZoTpzOUEhyN6IN5O6k9/4hYvXrKhMVYxWcNb/UvL9J7pwZqe35/tbJM3jn5HeP5KAmcTkG+5l32vsj9RtHr3EKaVZlx0+UPTwP97L1yt4RedXfTtqZLTik7/6X5g/yIin53+PxfC2VLmckqsn02lv394yq/uTWbfff5u3MUqY/2bVrA/JyKPFGWrHd9aBHS6SLlqr/atK24ytvrzayLyE9Oea1Y+E45bjzyqd3UrXb6HwA8J7FWJRsDpQw5bQ1dlectwxsgvtrZitQdxadrrNVtqhTd3X215NaS2puJd62dbhG1NWspEQ2elgK15xtprRwgbrs0z1ycjcBYB8QPeurvu23e2Y9kqH31ar7Vwa4WkxFfjR2VIbWeT/DAs13oVunHVXpOfobdH2azXouXae1xlj/zxjBMSqHnxI2LyMfva1vKtcpfjAkelcysfa79/+i588vjam9z1utX971TcbyE1rXRfnMJn9pia3pHPwvN3M6E+WJGnPW+xwW4VEx3HsP8vScPEQstRw3ZJGlwDgc0EziAgvvdxdEjDz04aeUC9dBytzP9ARO6ZvvAVuI436EfHQmyre9ug0NY/bHbECw+wSld/6nYzvzHlY+5yW4fxD3fbuY+8QrwUx/tFRKeA24e1JEd5E8/dncAZBMR6Bi0GVEednbS743R+oB9kXjOrqXO2SR4CuQhkF5CWvQ/zjHKNRJRQVi7PpjQQgMDhBLILSMvehxmrXItwdNjscCchAQhAAAJzBLILiK06b12JRx1Q5y2BAAQgsJhAZgHx4avW5Syn9bYWsMUOwIUQgAAEagm0rlhr81lzX4/wlc9nueNv7x1raxhyDwQgAIGLBDILiA1m92z9+wH1Ec7N4FWAAAQgsBuBrAKiISQ9OU63yehZRt8LGX11+m5OxYMgAIFzEOhZuR5J2CpuXeH87iMTWvBs3wthSu8CYFwCAQjEIJBVQEYIX5kH+F4IYawY7wW5hAAEFhDIKCB+9tUILX4/I4sw1gKn5BIIQCAGgYwC0nv21Zzl/XbvI4haDO8klxCAwNAEMgrISOErM74/CZEw1tCvBJmDAASWEsgmID58tfehUUuZXrrOhC1aGMufkud3ki13jdXdcMudZu3//iCq8nflxQ60W72L+yHQgUA2ARkxfFUOpuuRse/sYOtbSdrW6Y+JyC9PU6B1C/WWHxUSTfPrInKfO0K3FBjNqwmR/3kpr3aNPlPP2LCPF0cvbKUQzgmg5cnyUqbt83xJIO3v37iQcWXxb9N3di1i29IjSesqgWwCYq38HqfR3XK1EQb3y96EniVuW6NvPcTpVvn5fl8CXlD0dzsj3g6j2jc1ngaBGQKZBKTH1u1rnarn+MzR548bC98y17+VLeZL/y97FZfOX7/G/Fbr/AEReUFEtMVf9lzK9G4961o+5npIt3xlrkdlh0350wxN9PV5/sAt/3zLu/ZevjqV1w4Bu5UPvofAYgKZBMQPVI82/mEGsRBb6x7SnuePW+VkJwBq2Tije/Erd8iF1ovU43P9YVulqKiI/JOIPHtILnjo6QhkEhC/YG/Ucvk1IS2n8/rzx7VV+h9Fz8Bi8Nq61XECPb7WQiHWWic0Eqd6UD97RER+/EKIkpmAcWw5dE5HrWhroNnZH1rRaeU86qfXGSWj8iBfxxPw4V1NrXUP+PgSkkIXApkE5AcTwdGnyVqoTYWOLd67uP0pE33irkfylCt5yx7wKYGfodBZBCTCALr3JxtMH3Ws5gy+f8Yy+o09R29ondE+4cqcRUAiDKB757CtTXiJw70yoTPst9QZPdQbGvRZMp9FQCIMoHuf8oJHKOEsb1v/cvoeyEsi8vb+WSIHkQlkEZAoA+hzYSxmxER+g2Ll/TvTLDvNNT2QWLYbMrcISD+zEMbqx/6sKfseCDOxzuoFO5Y7i4DYDKye55+vNQthrLXEuH4rAQRkK0HufwOBDAISbQbWXBgrymwsv1/WR0REFx7qQkPd9E8XrelH/27XaSuXPZrGqXQQkHFskSInGQTEz29/VESeCWSZnntjLcGkQqC786oo6Gr2ty656co1kXqIG4s65O0IyJBmiZupDAKilZsOousnSkvePKbX3ljXPNZEQyv7Iz7MOjuC6rJn2mQTvZpB9GXMuOoKgQwCEm0NiDeHF7/eFest4XhZRPTfK26fLC3LvXdnVvyqiOi00E9MhdOwle+9+DKzAr9flcQ6kH7sU6acQUD8GpDelXCNk1hYoWfePUMrg1b0tgX4kzUFc/eUz2cB5Uaglbd/ZdooU28f9WCzyqJxWw8C2QQkYnksrNBjPYj2gD7n1gZYaEMr+K2iUfpzKSI9BbPHuzZCmn4MhBDWCBYJnoeIFW6J3HfLI5bHKtbWrfKyQrcex97C4e3lK7Aeghn8dd2cff+usA5kM04eELHCLa0WcRX63DhIq5CCjk1oRaK9D/u0qky8gHxKRD7OK9iUgB8vpAfSFH3OxBCQMez6XRG5ZzrHZMtRqrdK4wft7dqWPQEfg/+yiHzoVob5flcCXkD0wRne/10B8bB1BDI4kPVAWrWi1xFedrW1zI+szMvKQ3lpuEp/tvqUeWAcpBX5V9OBf1ve6VPLJCCRu+RH74tVVhw9F/RxJkW/aqXsgUZbN9WPHCnPEsgkIJF7IFbBH1GGstI4spez5DVjNtYSSsdcUx5t29sXjiklT21GIIOAWOs9cg9EDW4bQu4Z1ikrjFFanMzGavaKvykh8zP9AgHpZ4cUKWcSEDXInpVvawPvPQ6ie1fpGg/d6FA/PcNWJUumk7b2rtfT8+I9kk/0I0LK1QQyCEiWbdH3HAfRnsff3W0s+eDkGa3XmNxySAZzbxE67nvGoI5je7onZxCQyLvxeofbcxzEb5r3dRF534CeTRirj1G8b4zWsOhDhFSrCWQQkMi78ZaG22McxFcQRwzKVztbcSMV2V4k1z2H8OE6Xlx9hQACMpZ7bB0H8aGh0VuXPq8jC91YHrI9NwjIdoY8YSKAgIzlClvHQUyAolTIPowVeQLEWF50PTd+GnX0mYuRuKfMawYB8VNVR5mmWussW8ZBIk4meEFE7p9g/aKIPFsLjvsWE2A7k8WouPAWgQwC4sdAMsxrrx0Hsdb86KEr75M6zfjh6Q8ZbHfrfRvh+3JhKT2/EawSNA8ZBMT3QDJUQjXjIBF7H/rK+MosStgt6Kv+WrbLxaUISHSLdsx/BgFRfNZqz7AwqmYcxGY0Rep9mNv7cZAs/tjxlV6UNGNPizBx0S0CWV7YiOGbS7ZZOw7iW5QRW5N+VlD0Maxb79so33sBgfkoVgmYDwRkTKOtGQexWTWtDqTam5gPv2UIQe7N54jn+TU4MD+C8EmemUVArBWbJY6+ZhzEro0avvPjIBFDcBGrCt/rQ0AiWnCQPGcTkCzz2peOg/jwVVQB8WNYWRoAg7zeF7NBr290CwXJXxYB8S9EhjItHQfxi8Iil5uB9LYVhu/1RW54tKVGam8iELnS8YXxL0TEgeQ517RK9Vp57JroPS9mBbWvnGycjbBhe/ZpUswiID6Uk2VFsw10XpolkyV8pS+TH9TN0gAYvZLINHNxdNZp85dFQHwcPcugoI2DXAox+PBV9DIzlbd9FWOizbhTe/ZpUswkINlaVBaWu/SC+6NJo9sRAWlfpWSbudieIClK9IrHm3DpzKVIZr80DuLDV9HHP9QeT4vI45NhfldE/jySkYLm1SZqZPCfoCaIn+1MAmIhnUxdcgszlOMCPnyVYRbNn4rI702vk4XjVCT1Yz/tbVP78tlOwE88yVQPbCfDExYTyOQ4GWdimVCUYxx+0Dn6VhR6JPHPioi2iPXzooi864YHa6tZheSLdwKjs4j41BH4rojcIyJMXKjjd/q7MglI9D2h5pzRRNFPtSx3U41oQxWLDzvR2PIifv8u/PWSiLx89zwVFvvY7/rzG8Xf9W/+2i3pR753yVTxyOUj7wcTiFj5XEOyZguQg9Hu9ngtk1Z22tPQT9TxDxWNx6Yt3HeDs/FBJiIWFtMejfVuNj46xO3Wk40+iy8E7IyZzCYgZxhI9+MfEcZ7VDg0z+VYxrX3yXoIvmIvr9fn/byIfGAKw7wypbEmnVt5uE9E/lFEvup6MaXoRK4Xbk0Vj1w28t6AQDYBiXqw0jVT20tuYx2RBtD9WM1cGTU09zUR+eY0E0vHPvaaFVQKif7f/vaeQmz8d2teO99b0d6LCl6k0Ji9L6xGX2N1rn2NQDYB0YJli+vaS25hBl8pjzwD65J4aGU1V9mOsB+Wn/mlvz8kIj/ihEfHpG59fO9Jx15GHuRfuufarTLz/UkJZBQQq7hGrlzXuJuNefy9iPyKE0h9xqgzsObEQ1vnKoKXWuj+ntH90nos+lMnA+jPa+Kig/xfnmaYmUiZ0JiYrvGJva5lKu9eJE/6nNFf1BqzZGxVfUdENB6v0y21pW6fEQVkTjyWhEgiCcglvzQhWSIq/hkqJsroyRqH33BPxpmLG3Bw61oCGQVEGWSb327jILpR5JeckUezn19RbtlcIh56bcYNFa238Yci8sIExI/NlD2XHr3mNadfrq1fuD45gdEqoL1wf2tajJZleqJfD2IL7vYabN6LuT7Hekr2zDUVYoYeSA1LFREtuw9tqd+2WnFvY08j9mZreHJPQwJZBSTjTqP6outU1Qcn/xhxCq8fCNdsrvGvswqIclLx0Nl11jjQv9nan6NndWVcO9WwCj13Umte8Eik/O6uWbZpKCvnz95Ngf31wYzidwjWrK1hbwIyYs+qBWYVEV1oqb02+7ToFbCYsIV1k6aRVUD87JIsYSwviuqOEXogNjC8pBV9dgGxKuajIvKZ6T8tBITFhEkr9xbFyiogyi7bkZ2lgIzYA/ELOc1/lw6iWw9rRGFs8S5aGr7x01JAltqpJQvSGpxAZgHJds52WTmP+sL7lfLq/rrZ4fsWrNDOdiBY7avvp9a26D2bvUb1p1qO3NeAQGYB8S32Fi/i0ebyoY1RQ1jG4HMi8rADsqRysh7jmplbRzPv8XwvIEu4bc1jxnVTW5lw/0ICmQXEt9hbvIgLkVdfpttq+DUgI4d6tBJ8zp3rsWRgHAF53TVahvM4mbD6leTGzAJSnpuxZkbQiJ7hY+Oj90A0f2XI7VYv0ATk1nUj2mbvPBmLFo0EtjPZ23onel5mAVEz+nGQ6BVTlDEQe31UwDWMaHtE3eqFWKXZYuB45FfcV+itwnmsRh/ZIwbOW3YB8eMgLVpzR5o6moAoi7LXdCmU6HuLZxcQv6CyVaOHxYRHvrmJn51dQMoKLHIYqxQQ3d31QwF804u49kJ0w8Byi3MvINl98prJ/Ay2Wz22PU2PgOxJ80TPOsPL6sNYrUICR7hQKYbPi8gHj0ho52fO7fVUiogXxzP45Bzicsyupa9mPMlzZzfmcXMEzvCylq06DZEsWRk9mseUAqL5i2K/snIsty83G0UPM27xmb+5Ozr3kekBLXsfmqQJyJn5b7Hdae+NUgFtMVBZ8baKK2/J86V7dTPFH3VfRrJfaQcvImdvAT8hIk85u7bsfWiyCPgRb+sJnhmpAtpiDh/GirwmpNysMJr9ynCWnoWuK9VtK/PWFecWn9rr3lJYXxSRd+/18IXPQUAWguKyNxKIVgHV2q8cgI46mF6etxHRfqWIeJtGtUutX+p95S7LPWahISBbLHjieyNWQLXmyjCYnkFA1H6liOiZ4b/W8BClWh/a+77y+N8e4qFlsnxE7p3vbRuet4DAmQSknE6qrd1on/8VkXdMmf62iLwzWgFcflVEdNvy907i8WzgstRkfaSdBaxxdcYQYo3tuGcicCYBKV/YXq29Lc7neyAvi8jbtjyMe7sSKHsfPcN37EPW1RXiJn4mASnjzRG76whI3HfN53ztPmFHltpPsaYHciTphM8+m4CUZ1X0bPXVuNP/ici90406pffHah7CPd0J+PG43msvfM/8URF5pjsdMhCGwNkEpBy8/fwUf49iMN8Dab3YLAqj0fNZnizZO5TqG1W98zK67chfQeBsAqLFL2PPkbrt+rL/9jSQHnlB5FlfxKWbS7bkYwJCg6Ql9SRpnVFAylW/+uJE2t7EFt1F3I4lyWtTVYy5lfgjzARsefZIFThuGpfAGQVErVGOhUQcUB/Xq8hZSWBuL7ARGi0MoOOrmwicVUDKw44UYqRQ1iajc3NTAuprXxGR+6ZUR+rx+oZUtAklTY1IYvMEziogSuPa5n74CwT2IuAr6dEWf9p4IOMfe1n7ZM85s4DMhbL0b4SzTvYSHFhcHyIaTTy02Db+gc8f6ASZH312AdEX/LEpfGV21hXe7w96ZkhmX41Yth7H0y7lxPjHUlJcd5HA2QXEwESe2ot7j0mg1/G0S2mw/mMpKa5DQBb4wAsicr+7jnUWC6BxySyBctbViAPUjH/gvJsJ0AN5HWE5tXek2TKbDc0DmhLwvjTq7D7WfzR1iZyJISBvtGspIs9PW52waC+n/x9RqodE5EvTg/XExQeOSGTjMxn/2AiQ218lgIC82RPKUJY/uxu/gcAtAn48bdS91nxDiTrglkX5njGQFT7wtIg8PnP9qKGIFUXj0oMJlGuLRhz7UAS2GzDrPw52iOyPp/Uxb+EylGVXISLZ34j68pUD56P6CuGrehtzZ0EAAbnsEnMioi22J6fFhjgTBDwBH7oauWXP7rv47W4EEJDLKOf2y9KrdWD0k5OQ7GYIHhSaQBn2HPVcDXofod1svMwjINdtUoYl7Go9DVDXiXB623g+3TpHHxWRz7hER94WhMHz1t6RPD0E5LaBy/Or7Y4/E5Hfv307VyQnYOsptJi6Dc7bBi6vhdlGHZ8ZGB1ZmyOAgCzzizkRGbmluaxUXLWVQLkFzuhnimsPRGeKae+ZtU1brc/9rANZ4QNlnPsL00mGKx7BpYkIlI0Ktr5JZFyKsowAPZBlnOyqcmbWqPP815WKq9cQmNvBmcbEGoJcm4YAArLelJ++6/5r61M/hLHW84t8x6X1QaPOuorMmrwHIICA1BnJVvLq3fRC6hhGu+vSjDzEI5olye9uBBCQOpS+FzL6wGldCbmrJFAKCLs14yOnJ4CA1LmALiT82HTrp+4WF3687jHcFYyAzWLSMQ/dkYAPBE5NAAGpM7+2Rp8TkXs5/rYOIHdBAALxCSAg8W1ICSAAAQh0IYCAdMFOohCAAATiE0BA4tuQEkAAAhDoQgAB6YKdRCEAAQjEJ4CAxLchJYAABCDQhQAC0gU7iUIAAhCITwABiW9DSgABCECgCwEEpAt2EoUABCAQnwACEt+GlAACEIBAFwIISBfsJAoBCEAgPgEEJL4NKQEEIACBLgQQkC7YSRQCEIBAfAIISHwbUgIIQAACXQggIF2wkygEIACB+AQQkPg2pAQQgAAEuhBAQLpgJ1EIQAAC8QkgIPFtSAkgAAEIdCGAgHTBTqIQgAAE4hNAQOLbkBJAAAIQ6EIAAemCnUQhAAEIxCeAgMS3ISWAAAQg0IUAAtIFO4lCAAIQiE8AAYlvQ0oAAQhAoAsBBKQLdhKFAAQgEJ8AAhLfhpQAAhCAQBcCCEgX7CQKAQhAID4BBCS+DSkBBCAAgS4EEJAu2EkUAhCAQHwCCEh8G1ICCEAAAl0IICBdsJMoBCAAgfgEEJD4NqQEEIAABLoQQEC6YCdRCEAAAvEJICDxbUgJIAABCHQhgIB0wU6iEIAABOITQEDi25ASQAACEOhCAAHpgp1EIQABCMQngIDEtyElgAAEINCFAALSBTuJQgACEIhPAAGJb0NKAAEIQKALAQSkC3YShQAEIBCfAAIS34aUAAIQgEAXAghIF+wkCgEIQCA+AQQkvg0pAQQgAIEuBP4fQwsHFPwQZhEAAAAASUVORK5CYII=',
                'created_at' => '2024-10-28 15:30:22',
                'updated_at' => '2024-10-28 15:30:22'
            ]
        ]);
    }
}
