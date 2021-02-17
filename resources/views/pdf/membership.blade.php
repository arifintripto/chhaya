<div>
    <div style="position:relative;">
        <img style="width: 100%;" src="https://chhaya.xyz/uploads/member.png">
        <div style="position: absolute;top: 18%;left: 61.5%;">
            <b style="color:#109548">Name: </b>{{$name}}<br>
            <b style="color:#109548">Cell: </b>{{$mobile}}<br>
            <b style="color:#109548">Package(s): </b>
            @foreach($package as $p)
               {{ $p['title'].' ('.$p['expire_date'].')' }}<br>
            @endforeach
            <br>
        </div>
    </div>
<div>