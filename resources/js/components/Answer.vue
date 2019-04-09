<template>
    <div class="media post">
        <div class="d-flex flex-column">
            <vote name="answer" :model="answer"></vote>
        </div>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea cols="10" rows="10" v-model="body" class="form-control"></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" type="button"  @click.prevent="cancel">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-small btn-outline-info"> Edit question</a>
                            <button v-if="authorize('modify', answer)" @click="destroy" class="btn btn-small btn-outline-danger"
                            >delete</button>
                        </div>
                    </div>

                    <div class="col-4">
                    </div>

                    <div class="col-4">
                        <user-info :model="answer" label="answered"></user-info>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vote from './Vote';
    import UserInfo from './UserInfo';
    import  modification from '../mixins/modifications';

    export default {
        props: ['answer'],
        components: {Vote, UserInfo},
        mixins:[modification],
        data(){
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null
            };
        },
        methods:{
            setEditCache(){
                this.beforeEditCache = this.body;
            },
            restoreFromCache(){
                this.body = this.beforeEditCache;
            },
            payload(){
                return {
                    body: this.body
                };
            },
            delete(){
                axios.delete(this.endpoint)
                    .then(res=>{
                        this.$emit('deleted');
                    });
            }
        },
        computed:{
            isInvalid(){
                return this.body.length < 10;
            },
            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>