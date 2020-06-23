'use strict';

const app = new Vue({
    el: '#app',
    data: {
        displayName: '',
        userId: '',
        statusMessage: '',
        pictureUrl: '',
    },

    methods: {
        //プロフィール取得関数
        getProfile: async function(){
            const accessToken = liff.getAccessToken();
            const profile = await liff.getProfile();
            this.displayName = profile.displayName; //LINEの名前
            this.userId = profile.userId; //LINEのID
            this.pictureUrl = profile.pictureUrl; //LINEのアイコン画像
            this.statusMessage = profile.statusMessage; //LINEのステータスメッセージ
        },

        //ログアウト処理の関数
        logout: async function(){
            if (liff.isLoggedIn()){
                alert('ログアウトします。');
                liff.logout();
                window.location.reload();
            }
        }
    },

    //ページを開いた時に実行される
    mounted: async function(){
        const urlParam = location.search.substring(1);
        if (urlParam == 'tall') {
            await liff.init({
                liffId: '1653560615-RNopK0y6'
            });
            alert('tall');
        } else {
            await liff.init({
                liffId: '1653560615-926lNYBV'
            });
            alert('compact');
        }


        //LINE内のブラウザかどうか
        if(liff.isInClient()){
            console.log('LINE内のブラウザ');
            this.getProfile(); //LINE内で開いた場合は特にログイン処理なしで大丈夫
        }else{
            //外部ブラウザかどうか
            if(liff.isLoggedIn()){
                console.log('外部ブラウザ');
                this.getProfile();
            }else{
                liff.login();
            }
        }
    }
});