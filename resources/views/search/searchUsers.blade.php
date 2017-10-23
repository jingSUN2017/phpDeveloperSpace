<div class="media">
    <div class="media-body">
        <a href={{route('blog.getBlogs',['user_id'=>$user->id])}}>{{$user->getUsername()}}</a>&nbsp;
        @if($user->first_name ===null && $user->last_name ===null && $user->position ===null && $user->hobby ===null && $user->status ===null)
            | null
        @else
            <?php echo $user->first_name ===null || $user->last_name ===null?'':' | Name: '.$user->first_name.' '. $user->last_name;?>
            <?php echo $user->position ===null?'':' | Position: '.$user->position;?><?php echo $user->hobby ===null?'':' | Hobby: '.$user->hobby;?>
            <?php echo $user->status ===null?'':' | Status: '.$user->status;?>
        @endif
    </div>
</div>