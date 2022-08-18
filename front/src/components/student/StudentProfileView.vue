
<template>
    <div class="contianer">
        <div class="card">
            <div class="card_profile">
                <img src="@/assets/logo.png" alt="" class="img-profile">
            </div>
            <div class="card_body">
                <div class="student-name">{{student.username}}</div>
                <ul>
                    <li><span class="bold-text">Class: </span> <span>{{student.class}}</span></li>
                    <li><span class="bold-text">Batch: </span> <span>{{student.batch}}</span></li>
                    <li><span class="bold-text">Gender: </span> <span>{{student.gender}}</span></li>
                    <li><span class="bold-text">Email: </span> <span>{{student.email}}</span></li>
                </ul>

            </div>
        </div>
    </div>
</template>
<script>

export default({
    props:{student:Object}
})
</script>

<style scoped>
    .contianer{
        width: 50%;
        margin:2rem auto;
    }
    .card{
        width: 60%;
        margin: auto;
        padding: 5rem 0;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }
    .card_body{
        text-align: center;
        padding: 10px 2rem;
    }
    ul li{
        list-style: none;
        padding: 10px 0;
        display: flex;
    }
    .card_profile{
        border-radius: 50%;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-profile{
        margin: auto;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        width: 5rem;
        height: 5rem;
        border-radius: 100%;
    }
    .student-name{
        font-weight: bolder;
    }
    .bold-text{
        text-align: start;
        font-weight: bolder;
        width: 6rem;
    }
</style>