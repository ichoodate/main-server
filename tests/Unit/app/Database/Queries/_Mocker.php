<?php

namespace Tests\Unit\App\Database\Queries;

class _Mocker {

    public static function count($mock, $return)
    {
        $mock->shouldReceive('count')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function delete($mock)
    {
        $mock->shouldReceive('delete')->withNoArgs()->once()->ordered();
    }

    public static function first($mock, $return)
    {
        $mock->shouldReceive('first')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function find($mock, $id, $return)
    {
        $mock->shouldReceive('find')->with($id)->once()->ordered()->andReturn($return);
    }

    public static function findMany($mock, $ids, $return)
    {
        $mock->shouldReceive('findMany')->with($ids)->once()->ordered()->andReturn($return);
    }

    public static function get($mock, $return)
    {
        $mock->shouldReceive('get')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function getQuery($mock, $return)
    {
        $mock->shouldReceive('getQuery')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function qGroupBy($mock, $value)
    {
        $mock->shouldReceive('qGroupBy')->with($value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function limit($mock, $value)
    {
        $mock->shouldReceive('limit')->with($value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function lockForUpdate($mock)
    {
        $mock->shouldReceive('lockForUpdate')->withNoArgs()->once()->ordered('mid')->andReturnSelf();
    }

    public static function orderByRaw($mock, $raw)
    {
        $mock->shouldReceive('orderByRaw')->with($raw)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qOrderBy($mock, $order, $direction)
    {
        $mock->shouldReceive('qOrderBy')->with($order, $direction)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qOrWhereIn($mock, $field, $values)
    {
        $mock->shouldReceive('qOrWhereIn')->with($field, $values)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qSelect($mock, $value)
    {
        $mock->shouldReceive('qSelect')->with($value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhere($mock, $field, $value)
    {
        $mock->shouldReceive('qWhere')->with($field, $value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhereBetween($mock, $field, $values)
    {
        $mock->shouldReceive('qWhereBetween')->with($field, $values)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhereIn($mock, $field, $values)
    {
        $mock->shouldReceive('qWhereIn')->with($field, $values)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhereNotIn($mock, $field, $values)
    {
        $mock->shouldReceive('qWhereNotIn')->with($field, $values)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhereNull($mock, $field)
    {
        $mock->shouldReceive('qWhereNull')->with($field)->once()->ordered('mid')->andReturnSelf();
    }

    public static function qWhereOp($mock, $field, $operator, $value)
    {
        $mock->shouldReceive('qWhere')->with($field, $operator, $value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function relatedQuery($mock, $name, $return)
    {
        $mock->shouldReceive($name . 'Query')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function union($mock, $value)
    {
        $mock->shouldReceive('union')->with($value)->once()->ordered('mid')->andReturnSelf();
    }

    public static function unionAll($mock, $value)
    {
        $mock->shouldReceive('unionAll')->with($value)->once()->ordered('mid')->andReturnSelf();
    }

}
