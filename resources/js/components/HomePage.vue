<template>
    <div class="container mt-5">
        <h2>Комментарии</h2>
        <comment-form></comment-form>
        <button type="button" class="btn btn-primary" @click="openModalWithNull">Добавить комментарий</button>

        <div v-for="comment in comments" :key="comment.id" class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ comment.user_name }}</h5>
                <p class="card-text">{{ comment.text }}</p>

                <div v-for="child in comment.children" :key="child.id" class="card mt-3 ml-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ child.user_name }}</h5>
                        <p class="card-text">{{ child.text }}</p>
                    </div>
                </div>
                <button class="btn btn-primary" @click="openModal(comment.id)">Написать комментарий</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CommentForm from './CommentForm.vue'

export default {
    components: {
        CommentForm
    },

    data() {
        return {
            comments: []
        };
    },
    methods: {
        openModalWithNull() {
            this.$emit('open-modal', null);
        },
        openModal(commentId) {
            this.$emit('open-modal', commentId);
        }
    },

    mounted() {
        axios.get('http://127.0.0.1:8000/api/comments')
            .then(response => {
                this.comments = response.data.data;
                console.log(this.comments)
            })

            .catch(error => {
                console.error("Ошибка при получении комментариев:", error);
            });
    }
}
</script>
