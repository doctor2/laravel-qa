<template>
    <div>
        <div>
            <a href="Click as favorite" v-if="canAccept"  @click.prevent="create" :class="classes"
            >favorite
                <span class="favorites-count">1f</span>
            </a>

            <span  v-if="accepted">This is favorite answer!</span>
        </div>
    </div>
</template>

<script>
    import EventBus from '../event-bus';
    export default {
        props: ['answer'],
        data(){
            return {
                isBest: this.answer.is_best,
                id: this.answer.id,
            }
        },
        created(){
            EventBus.$on('accepted', id => {
               this.isBest = (id === this.id)
            });
        },
        methods:{
            create(){
                axios.post(`/answers/${this.id}/accept`)
                    .then(res => {
                        this.$toast.success(res.data.message, "Success", {
                            timeout: 3000,
                            position: 'bottomLeft'
                        });

                        this.isBest = true;
                    });

                EventBus.$emit('accepted', this.id);
            }
        },
        computed:{
            canAccept(){
                return this.authorize('accept', this.answer);
            },
            accepted(){
                return !this.canAccept && this.isBest;
            },
            classes(){
                return [
                    'favorite',
                    this.isBest ? 'vote-accepted' : ''
                ]
            }
        }
    }
</script>
