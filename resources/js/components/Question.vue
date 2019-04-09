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
                            <button class="btn btn-outline-secondary" type="button" @click.prevent="cancel">Cancel
                            </button>
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
                                        <a v-if="authorize('modify', question)" @click.prevent="edit"
                                           class="btn btn-small btn-outline-info"> Edit question</a>
                                        <button v-if="authorize('deleteQuestion', question)" @click="destroy"
                                                class="btn btn-small btn-outline-danger"
                                        >delete
                                        </button>
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
    import modification from '../mixins/modifications';

    export default {
        props: ['question'],
        components: {Vote, UserInfo},
        mixins: [modification],
        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                id: this.question.id,
                beforeEditCache: {}
            };
        },
        computed: {
            isInvalid() {
                return this.body.length < 10 || this.title.length < 10;
            },
            endpoint() {
                return `/questions/${this.id}`;
            }
        },
        methods: {
            setEditCache() {
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
            },
            restoreFromCache() {
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
            },
            payload() {
                return {
                    body: this.body,
                    title: this.title
                };
            },
            delete() {
                axios.delete(this.endpoint)
                    .then(({data})=>{
                        this.$toast.success(data.message, 'Success', {timeout: 2000});
                    });

                setTimeout(() => {
                    window.location.href = '/questions'
                }, 3000);
            }
        },
    }
</script>