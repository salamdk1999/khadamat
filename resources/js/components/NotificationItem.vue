
<template>
    <div class="wrap" dir="rtl">
        <a :href="orderUrl">
            <!-- اسم اليوزر يلي بعت اشعار والعنوان -->
            <!-- {{ unread.data.user }} {{ unread.data.title }} -->
             <h6 class="d-inline font-weight-bold">{{ unread.data.title }}</h6>
            <h6 class="d-inline text-info font-weight-bold">{{ unread.data.user }}</h6>
        </a>
        <p><small class="text-warning">{{unread.created_at}}</small></p>
        <hr>
    </div>
</template>

<script>
    export default {
        props:['unread'],
        data(){
            return {
                orderUrl:"",
            }
        },
        mounted(){
            if (this.unread.data.user_id==1){
                this.orderUrl= "user_details_service/"+ this.unread.data.service.id
            }
            else{
                this.orderUrl= "provider_details_order/"+ this.unread.data.order.id
            }
        }
    }
</script>
