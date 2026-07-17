@props(['id', 'name', 'value' => ''])
<div class="task-jalali-picker" x-data="jalaliTaskPicker(@js($value))" x-init="init()" @click.outside="open=false">
    <input id="{{ $id }}" name="{{ $name }}" class="form-input task-date-input w-full" x-model="value" @focus="show()" @click="show()" placeholder="مثال: 1405-02-24" readonly>
    <button type="button" class="task-date-trigger" @click="show()"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M8 2v4M16 2v4M4 9h16M6 4h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></button>
    <div x-cloak x-show="open" x-transition class="task-jalali-popover">
        <div class="task-jalali-head"><button type="button" @click="change(-1)">‹</button><strong x-text="months[month-1]+' '+year"></strong><button type="button" @click="change(1)">›</button></div>
        <div class="task-jalali-year"><button type="button" @click="year--">−</button><span x-text="year"></span><button type="button" @click="year++">+</button></div>
        <div class="task-jalali-week"><span>ش</span><span>ی</span><span>د</span><span>س</span><span>چ</span><span>پ</span><span>ج</span></div>
        <div class="task-jalali-days"><template x-for="(day,i) in days()" :key="i"><button type="button" :disabled="!day" :class="{selected:day&&value===format(year,month,day)}" @click="day&&choose(day)" x-text="day||''"></button></template></div>
    </div>
</div>
@once
<script src="/assets/js/jalaali.js"></script>
<script>
function jalaliTaskPicker(initialValue) { return {
    open:false, value:initialValue||'', year:null, month:null,
    months:['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'],
    today(){const n=new Date(),d=jalaali.toJalaali(n.getFullYear(),n.getMonth()+1,n.getDate());return {year:d.jy,month:d.jm,day:d.jd}},
    init(){if(!this.value){const d=this.today();this.value=this.format(d.year,d.month,d.day)}},
    parse(){const m=String(this.value).match(/^(\d{4})-(\d{1,2})-(\d{1,2})$/);return m&&jalaali.isValidJalaaliDate(+m[1],+m[2],+m[3])?{year:+m[1],month:+m[2],day:+m[3]}:null},
    show(){const d=this.parse()||this.today();this.year=d.year;this.month=d.month;this.open=true},
    format(y,m,d){return `${y}-${String(m).padStart(2,'0')}-${String(d).padStart(2,'0')}`},
    change(s){this.month+=s;if(this.month<1){this.month=12;this.year--}if(this.month>12){this.month=1;this.year++}},
    days(){const len=jalaali.jalaaliMonthLength(this.year,this.month),first=jalaali.jalaaliToDateObject(this.year,this.month,1),a=Array((first.getDay()+1)%7).fill(null);for(let d=1;d<=len;d++)a.push(d);return a},
    choose(d){this.value=this.format(this.year,this.month,d);this.open=false}
}}
</script>
@endonce
