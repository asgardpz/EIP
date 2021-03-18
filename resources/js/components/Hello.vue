<template>
    <div>
        <h1>
        <p class="hello">{{ name || '匿名' }} 您好</p>
        <p>{{ msg }}</p>
        </h1>
    </div>
</template>

<script>
    export default {
        props: ['name'],
        data () {
            return {
                msg: '歡迎使用訂餐系統'
            }
        }
    }
</script>

<style>
.hello {
    font-size: 2em;
    color: green;
}
</style>