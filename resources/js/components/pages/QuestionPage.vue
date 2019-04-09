<template>
    <div class="container">
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>

<script>
    import  Question from '../Question';
    import  Answers from '../Answers';

    export default {
        props: ['question'],
        components: {Question, Answers}

    }
</script>
