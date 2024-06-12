$(document).ready(function()
{

    $(document).on('click','.category_delete',function(event){
        event.preventDefault()
        let status=confirm("Are you sure to delete?");
        // console.log(status)
           
        if(status)
        {
            let id=$(this).parent().attr('id')
            console.log("id is "+id);

            $.ajax({
                method:'post',
                url:'delete_category.php',
                data:{id:id},
                success:function(response){
                    // alert(response)
                    if(response='success')
                    {
                        alert("Successfully deleted!")
                        location.href='category.php'
                    }
                    else
                    {
                        alert(response)
                    }
                },
                error:function(error){

                }
            })
        }
    })

    // $(document).on('click','.btn1_delete',function(event)
    // {
    //     event.preventDefault()
    //     let status=confirm("Are you sure to delete?");
    //     console.log(status)
           
    //     if(status)
    //     {
    //         let id=$(this).parent().attr('id')
    //         // console.log("id is "+id)
    //         $.ajax({
    //             method:'post',
    //             url:'delete_delivery_fee.php',
    //             data:{id:id},
    //             success:function(response){
    //                 // alert(response)
    //                 if(response='success')
    //                 {
    //                     alert("Successfully deleted")
    //                     location.href='delivery_fee.php'
    //                 }
    //                 else
    //                 {
    //                     alert("error")
    //                 }
    //             },
    //             error:function(error){

    //             }
    //         })
    //     }
    // })


    // $(document).on('click','.btn2_delete',function(event){
    //     event.preventDefault()
    //     let status=confirm("Are you sure to delete?");
    //     console.log(status)
           
    //     if(status)
    //     {
    //         let id=$(this).parent().attr('id')
    //         // console.log("id is "+id)
    //         $.ajax({
    //             method:'post',
    //             url:'delete_category.php',
    //             data:{id:id},
    //             success:function(response){
    //                 // alert(response)
    //                 if(response='success')
    //                 {
    //                     alert("Successfully delete")
    //                     location.href='categories.php'
    //                 }
    //                 else
    //                 {
    //                     alert(response)
    //                 }
    //             },
    //             error:function(error){

    //             }
    //         })
    //     }
    // })

    // $(document).on('click','.btn3_delete',function(event)
    // {
    //     event.preventDefault()
    //     let status=confirm("Are you sure to delete?");
    //     console.log(status)
           
    //     if(status)
    //     {
    //         let id=$(this).parent().attr('id')
    //         // console.log("id is "+id)
    //         $.ajax({
    //             method:'post',
    //             url:'delete_payment.php',
    //             data:{id:id},
    //             success:function(response){
    //                 // alert(response)
    //                 if(response='success')
    //                 {
    //                     alert("Successfully deleted")
    //                     location.href='payments.php'
    //                 }
    //                 else
    //                 {
    //                     alert(response)
    //                 }
    //             },
    //             error:function(error){

    //             }
    //         })
    //     }
    // })

   // $('#mytable').DataTable();
    
});