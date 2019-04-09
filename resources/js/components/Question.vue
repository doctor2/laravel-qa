<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="card" v-if="editing" @submit.prevent="update">
                <div class="card-header">
                    <input type="text" class="form-control form-control-lg" v-model="title">
                </div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea cols="10" rows="7" v-model="body" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                            <button class="btn btn-outline-secondary" type="button"  @click.prevent="cancel">Cancel</button>
                        </div>
                    </div>

                </div>

            </form>
            <div class="card" v-else>
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h1 v-text="title"></h1>
                        <div class="ml-auto">
                            <a href="/questions" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="media">
                        <vote name="question" :model="question"></vote>
                        <div class="media-body">
                            <div v-html="bodyHtml"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <a v-if="authorize('modify', question)" @click.prevent="edit" class="btn btn-small btn-outline-info"> Edit question</a>
                                        <button v-if="authorize('deleteQuestion', question)" @click="destroy" class="btn btn-small btn-outline-danger"
                                        >delete</button>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Vote from './Vote';
    import UserInfo from './UserInfo';

    export default {
        props:['question'],
        components: { Vote, UserInfo},
        data(){
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                editing:false,
                id: this.question.id,
                beforeEditCache: {}
            };
        },
        computed:{
            isInvalid(){
                return this.body.length < 10 || this.title.length < 10;
            },
            endpoint(){
                return `/questions/${this.id}`;
            }
        },
        methods:{
            edit(){
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
                this.editing = true;
            },
            cancel(){
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
                this.editing = false;
            },
            update(){
                axios.put(this.endpoint, {
                    body: this.body,
                    title: this.title
                })
                    .catch(({response}) => {
                        this.$toast.error(response.data.message, 'Error', {timeout: 3000});
                    })
                    .then(({data}) => {
                        this.bodyHtml = data.body_html;
                        this.$toast.success(data.message, 'Success', {timeout: 3000});
                        this.editing = false;
                    });
            },
            destroy(){
                this.$toast.question('Are you sure about that?', "Confirm", {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    toastOnce: true,
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {
                            axios.delete(this.endpoint)
                                .then(({data})=>{
                                    this.$toast.success(data.message, 'Success', {timeout: 2000});
                                });

                            setTimeout(() => {
                                window.location.href = '/questions'
                            }, 3000);

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }, true],
                        ['<button>NO</button>', function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ],
                });
            }
        }
    }
</script>