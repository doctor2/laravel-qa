<template>
    <div class="d-flex flex-column">
        <a @click.prevent="voteUp" href="" :title="title('up')" class="vote-up" :class="classes"
        > vote up</a>

        <span class="votu-count">{{count}}</span>

        <a @click.prevent="voteDown" href="" :title="title('down')" class="vote-down" :class="classes"
        >vote down</a>

        <favorite v-if="name === 'question'" :question="model"></favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
    import Favorite from './Favorite';
    import Accept from './Accept';

    export default {
        props: ['name', 'model'],
        computed: {
            classes() {
                return this.signedIn ? '' : 'off';
            },
            endpoint(){
                return `/${this.name}s/${this.id}/vote`;
            }
        },
        components:{
            Favorite: Favorite,
            Accept: Accept
        },
        data() {
            return {
                count: this.model.votes_count,
                id: this.model.id
            };
        },
        methods: {
            title(voteType) {
                let titles = {
                    up: `This ${this.name} is usfull`,
                    down: `This ${this.name} is not usfull`
                };

                return titles[voteType];
            },
            voteUp(){
                this._vote(1);
            },
            voteDown(){
                this._vote(-1);
            },
            _vote(vote){
                if(! this.signedIn){
                    this.$toast.warning(`Pleas login to vote the ${this.name}`, 'Warning',{
                        timeout:3000,
                        position: 'bottomLeft'
                    });
                    return;
                }

                axios.post(this.endpoint, {
                    vote: vote
                }).then(res => {
                    this.$toast.success(res.data.message, 'Success', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });

                    this.count = res.data.votesCount;
                })
            }
        }
    }
</script>

<style scoped>

</style>