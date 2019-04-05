<template>
    <div>
        <a v-if="canAccept" href="Click as favorite" :class="classes"
            >favorite 
            <span class="favorites-count">1f</span>
        </a>

        <span  v-if="accepted">This is favorite answer!</span>
    </div>
</template>
<script>
export default {
    props: ['answer'],
    data(){
        return {
            isBest:this.answer.is_best
        }
    },
    computed:{
        canAccept(){
            return true;
        },
        accepted(){
            return !this.canAccept && this.answer.is_best;
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
