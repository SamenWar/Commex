<template>
    <div>
        <div class="card mt-4">
            <h1>hg</h1>
            <div class="card-body">
                <h5 class="card-title">{{ comments.user_name }}</h5>
                <p class="card-text">{{ comments.text }}</p>

<!--                &lt;!&ndash; Рекурсивное отображение дочерних комментариев &ndash;&gt;-->
<!--                <comment-component-->
<!--                    v-for="childComment in childComments"-->
<!--                    :key="childComment.id"-->
<!--                    :comment="childComment"-->
<!--                    :comments="comments"-->
<!--                    class="ml-5"-->
<!--                ></comment-component>-->
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'CommentComponent',
    data() {
        return {
            comments: []
        };
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/comments')
            .then(response => {
                this.comments = response.data.data;
            })
            .catch(error => {
                console.error("There was an error fetching the comments:", error);
            });
    }
}
</script>
