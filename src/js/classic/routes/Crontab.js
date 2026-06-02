Ext.define('Tualo.routes.Crontab', {
    statics: {
        load: async function () {
            return [
                {
                    name: 'Crontab',
                    path: '#crontab/panel'
                }
            ]
        }
    },
    url: 'crontab/panel',
    handler: {
        action: function () {
            console.log('action');

            Ext.getApplication().addView('Tualo.crontab.Panel');
        },
        before: function (action, cnt) {
            console.log('before');
            let fn = Ext.require, txt = 'Tualo.Crontab' + '.Panel';
            fn(txt, function () {
                console.log('resume');
                action.resume();
            }, this);
        }

    }
});