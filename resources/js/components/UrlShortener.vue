<template>
    <div class="container p-5">
        <form @submit.prevent="submitUrl">
            <div class="form-group mb-3">
                <label>URL to Shorten</label>
                <input class="form-control" type="text" v-model="longUrl" placeholder="Enter URL to shorten">
            </div>
            <button class="btn btn-primary" type="submit">Shorten</button>
        </form>
        <div v-if="shortUrl">
            Short URL: <a :href="shortUrl">{{ shortUrl }}</a>
        </div>
    </div>
</template>
  
<script>
    export default {
        data() {
            return {
                longUrl: '',
                shortUrl: null
            };
        },
        methods: {
            async submitUrl() {
                console.log(this.$http);
                const response = await this.$http.post('/shorten', { long_url: this.longUrl });
                this.shortUrl = response.data.short_url;
            }
        }
    }
</script>
