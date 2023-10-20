<?php

namespace App\Imports;

use App\Factory\ProjectDynamicFactory;
use App\Factory\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Validators\Failure;

class ProjectDynamicImport implements ToCollection, WithEvents, WithStartRow, WithValidation, SkipsOnFailure
{
    use RegistersEventListeners;
 private static array $headers;
 private Task $task;

 public function __construct(Task $task)
 {
     $this->task = $task;
 }

    const STATIC_ROWS = 13;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        $typesMap = $this->getTypesMap(Type::all());

        foreach ($collection as $row) {
            if (!isset($row[1])) continue;
            $map = $this->getRowsMap($row);
            $projectFactory = ProjectDynamicFactory::make($typesMap, $map['static']);

            $project = Project::updateOrCreate(
                $projectFactory->getOriginalValues()
                ,$projectFactory->getValues()
            );
            if (!isset($map['dynamic'])) continue;

            $dynamicHeadings = $this->getRowsMap(self::$headers)['dynamic'];

            foreach ($dynamicHeadings as $key=>$value)
            {
                Payment::create([
                    'project_id' => $project->id,
                    'title' => $value,
                    'value' => $map['dynamic'][$key]
                ]);
            }
        }
    }

    private function getTypesMap( $types): array
    {
        $map = [];
        foreach ($types as $type){
            $map[$type->title] = $type->id;
        }
        return $map;
    }

    private function getRowsMap($row)
    {
        $static = [];
        $dynamic = [];
        foreach ($row as $key=>$value){
            if ($value){
                $key < self::STATIC_ROWS ? $static[$key]=$value : $dynamic[$key]=$value;
            }
        }
        return [
          'static' => $static,
          'dynamic' => $dynamic
        ];
    }

    public function rules(): array
    {

        return array_replace([
            '0'=> 'required|string',
            '1'=> 'required|string',
            '2'=> 'required|integer',
            '9'=> 'required|integer',
            '7'=> 'nullable|integer',
            '3'=> 'nullable|string',
            '8'=> 'nullable|string',
            '5'=> 'nullable|string',
            '6'=> 'nullable|string',
            '4'=> 'nullable|integer',
            '10'=> 'nullable|integer',
            '11'=> 'nullable|string',
            '12'=> 'nullable|numeric',
        ], $this->getDynamicValidation());
    }

    public function onFailure(Failure ...$failures)
    {
        processFailures($failures, $this->attributesMap(), $this->task);
    }



    public static function beforeSheet(BeforeSheet $event)
    {
        self::$headers = $event->getSheet()->getDelegate()->toArray()[0];
    }
    public function customValidationMessages():array
    {
        return [
            '2.string' => 'Дата создания должна быть в формате дата '
        ];
    }

    public function attributesMap():array
    {

        return array_replace([
            '0'=> 'Тип',
            '1'=> 'Наименование',
            '2'=> 'Дата создания',
            '9'=> 'Подписание договора',
            '7'=> 'Дедлайн',
            '3'=> 'Сетевик',
            '8'=> 'Сдача в срок',
            '5'=> 'Наличие аутсорсинга',
            '6'=> 'Наличие аутсорсинга',
            '4'=> 'Количество участников',
            '10'=> 'Количество услуг',
            '11'=> 'Комментарий',
            '12'=> 'Значение эффективности',
        ], $this->getRowsMap(self::$headers)['dynamic']);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getDynamicValidation():array
    {
        $dynamicHeaders = $this->getRowsMap(self::$headers)['dynamic'];
        foreach ($dynamicHeaders as $key=>$value){
            $dynamicHeaders[$key] = 'required|integer';
        }
        return $dynamicHeaders;
    }
}
