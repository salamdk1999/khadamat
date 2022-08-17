<template>
    <li class="dropdown" >
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="bi bi-bell" style='font-size:22px'></i>
            <span class="badge alert-danger" style='font-size:10px'>{{unreadNotifications.length}}</span>
        </a>

        <ul class="dropdown-menu" role="menu" dir="rtl" style="height:500px;width: 300px;overflow-y:auto;overflow-x:hidden;padding-bottom: 0px;">
        <a @click="markNotificationAsRead" class="font-weight-bold">تعيين قراءة الكل</a>
        <hr>
            <li>
                <notification-item v-for="unread in unreadNotifications" :key="unread.id" :unread="unread" ></notification-item>
            </li>
        </ul>
    </li>
</template>

<script>
    import NotificationItem from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid'], // userid معرفتو بالهيدر على انه الاوث
        // name: 'Notification',
        components: {NotificationItem},
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/MarkAsReadAll');
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                    let newUnreadNotifications = {data: {order: notification.order, user: notification.user, title:notification.title,user_id:notification.user_id,service:notification.service}};
                    this.unreadNotifications.push(newUnreadNotifications);
                });
        }
    }
</script>
