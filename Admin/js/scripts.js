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

    $(document).on('click','.sub_category_delete',function(event){
        event.preventDefault()
        let status=confirm("Are you sure to delete?");
        // console.log(status)
           
        if(status)
        {
            let id=$(this).parent().attr('id')
            console.log("id is "+id);

            $.ajax({
                method:'post',
                url:'delete_sub_category.php',
                data:{id:id},
                success:function(response){
                    // alert(response)
                    if(response='success')
                    {
                        alert("Successfully deleted!")
                        location.href='sub_category.php'
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

    $(document).on('click','.type_delete',function(event){
        event.preventDefault()
        let status=confirm("Are you sure to delete?");
        // console.log(status)
           
        if(status)
        {
            let id=$(this).parent().attr('id')
            console.log("id is "+id);

            $.ajax({
                method:'post',
                url:'delete_type.php',
                data:{id:id},
                success:function(response){
                    //  alert(response)
                    if(response='success')
                    {
                        alert("Successfully deleted!")
                        location.href='product_type.php'
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

   // $('#mytable').DataTable();
    
});